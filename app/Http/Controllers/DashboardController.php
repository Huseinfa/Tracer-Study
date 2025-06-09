<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LulusanModel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        *
        * filter
        *
        */
        $prodi = $request->input('prodi', '1'); // Default ke 1 (D4 TI) sebagai ID numerik
        $start_year = $request->input('start_year', now()->year - 4); // 2021 untuk 2025
        $end_year = $request->input('end_year', now()->year - 1); // 2024 untuk 2025

        // Validasi rentang tahun
        if ($start_year > $end_year || $start_year > now()->year || $end_year > now()->year) {
            $start_year = now()->year - 4;
            $end_year = now()->year - 1;
        }

        $baseQuery = LulusanModel::where('id_program_studi', $prodi)
            ->whereRaw('YEAR(tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year]);

        /*
        *
        * statistik
        *
        */
        $lulusanCount = $baseQuery->count();
        $lulusanFilled = $baseQuery->where('sudah_mengisi', true)->count();
        $lulusanNotFilled = $lulusanCount - $lulusanFilled;
        $lulusanFilledPercentage = $lulusanCount > 0 ? round(($lulusanFilled / $lulusanCount) * 100, 2) : 0;

        // Rata-rata masa tunggu (sesuaikan dengan baseQuery)
        $avgWaitingTime = DB::table('t_kuisioner_lulusan')
            ->join('t_lulusan', 't_kuisioner_lulusan.id_lulusan', '=', 't_lulusan.id_lulusan')
            ->where('t_lulusan.id_program_studi', $prodi)
            ->whereRaw('YEAR(t_lulusan.tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year])
            ->select(DB::raw('AVG(DATEDIFF(t_kuisioner_lulusan.tanggal_pertama_berkerja, t_lulusan.tanggal_lulus)) as avg_days'))
            ->first();

        $averageDays = $avgWaitingTime ? round($avgWaitingTime->avg_days) : 0;

        // Format rata-rata masa tunggu
        $averageWaitingTime = '';
        if ($averageDays > 0) {
            $years = floor($averageDays / 365);
            $months = floor(($averageDays % 365) / 30);
            $days = $averageDays % 30;

            if ($years > 0) {
                $averageWaitingTime .= $years . ' tahun ';
            }
            if ($months > 0) {
                $averageWaitingTime .= $months . ' bulan ';
            }
            if ($days > 0 || ($years == 0 && $months == 0)) {
                $averageWaitingTime .= $days . ' hari';
            }
        } else {
            $averageWaitingTime = '0 hari';
        }

        /*
        *
        * sebaran profesi
        *
        */
        $profesiData = DB::table('t_kuisioner_lulusan')
            ->join('t_profesi', 't_kuisioner_lulusan.id_profesi', '=', 't_profesi.id_profesi')
            ->join('t_lulusan', 't_kuisioner_lulusan.id_lulusan', '=', 't_lulusan.id_lulusan')
            ->where('t_lulusan.id_program_studi', $prodi)
            ->whereRaw('YEAR(t_lulusan.tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year])
            ->select('t_profesi.nama_profesi as profesi', DB::raw('COUNT(*) as count'))
            ->groupBy('t_profesi.nama_profesi')
            ->orderBy('count', 'desc')
            ->get();

        $total = $profesiData->sum('count');

        if ($total > 0) {
            $topProfesi = $profesiData->take(10);
            $profesilabels = $topProfesi->pluck('profesi')->toArray();
            $profesicounts = $topProfesi->pluck('count')->toArray();
            $otherCount = $total - array_sum($profesicounts);

            if ($otherCount > 0) {
                $profesilabels[] = 'Lainnya';
                $profesicounts[] = $otherCount;
            }

            $profesipercentages = array_map(function ($count) use ($total) {
                return $total > 0 ? round(($count / $total) * 100, 1) : 0;
            }, $profesicounts);
        } else {
            $profesilabels = [];
            $profesicounts = [];
            $profesipercentages = [];
        }

        /*
        *
        * sebaran jenis instansi
        *
        */
        $instansiData = DB::table('t_kuisioner_lulusan')
            ->join('t_jenis_instansi', 't_kuisioner_lulusan.id_jenis_instansi', '=', 't_jenis_instansi.id_jenis_instansi')
            ->join('t_lulusan', 't_kuisioner_lulusan.id_lulusan', '=', 't_lulusan.id_lulusan')
            ->where('t_lulusan.id_program_studi', $prodi)
            ->whereRaw('YEAR(t_lulusan.tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year])
            ->select('t_jenis_instansi.nama_jenis_instansi as instansi', DB::raw('COUNT(*) as count'))
            ->groupBy('t_jenis_instansi.nama_jenis_instansi')
            ->orderBy('count', 'desc')
            ->get();

        $totalInstansi = $instansiData->sum('count');

        if ($totalInstansi > 0) {
            $instansiLabels = $instansiData->pluck('instansi')->toArray();
            $instansiCounts = $instansiData->pluck('count')->toArray();
            $instansiPercentages = array_map(function ($count) use ($totalInstansi) {
                return round(($count / $totalInstansi) * 100, 1);
            }, $instansiCounts);
        } else {
            $instansiLabels = [];
            $instansiCounts = [];
            $instansiPercentages = [];
        }

        /*
        *
        * penilaian kepuasan stakeholder
        *
        */
        $evaluationFields = [
            'kerjasama_tim' => 'Kerjasama Tim',
            'keahlian_it' => 'Keahlian IT',
            'kemampuan_bahasa_asing' => 'Kemampuan Bahasa Asing',
            'kemampuan_komunikasi' => 'Kemampuan Komunikasi',
            'pengembangan_diri' => 'Pengembangan Diri',
            'kepemimpinan' => 'Kepemimpinan',
            'etos_kerja' => 'Etos Kerja'
        ];

        $evaluationData = [];
        $evaluationLabels = ['Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'];

        foreach ($evaluationFields as $field => $label) {
            $fieldData = DB::table('t_kuisioner_stakeholder')
                ->join('t_lulusan', 't_kuisioner_stakeholder.id_lulusan', '=', 't_lulusan.id_lulusan')
                ->where('t_lulusan.id_program_studi', $prodi)
                ->whereRaw('YEAR(t_lulusan.tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year])
                ->select($field, DB::raw('COUNT(*) as count'))
                ->groupBy($field)
                ->get()
                ->pluck('count', $field)
                ->toArray();

            $counts = [];
            $total = array_sum($fieldData);

            for ($i = 1; $i <= 5; $i++) {
                $value = (string)$i;
                $counts[$i - 1] = isset($fieldData[$value]) ? $fieldData[$value] : 0;
            }

            $percentages = $total > 0 ? array_map(function ($count) use ($total) {
                return round(($count / $total) * 100, 1);
            }, $counts) : [0, 0, 0, 0, 0];

            $evaluationData[$field] = [
                'title' => $label,
                'counts' => $counts,
                'percentages' => $percentages,
                'total' => $total
            ];
        }

        return view('dashboard.index', compact(
            'profesilabels',
            'profesicounts',
            'profesipercentages',
            'total',
            'instansiLabels',
            'instansiCounts',
            'instansiPercentages',
            'totalInstansi',
            'evaluationData',
            'evaluationLabels',
            'lulusanCount',
            'lulusanFilled',
            'lulusanNotFilled',
            'lulusanFilledPercentage',
            'averageWaitingTime',
            'averageDays'
        ));
    }
}
