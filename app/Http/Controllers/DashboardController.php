<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LulusanModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        *
        * filter
        *
        */
        $validator = Validator::make($request->all(), [
            'prodi' => 'nullable|in:1,2,3,4',
            'start_year' => 'nullable|integer|min:2000|max:' . now()->year,
            'end_year' => 'nullable|integer|min:2000|max:' . now()->year,
        ], [
            'start_year.min' => 'Tahun awal tidak boleh kurang dari tahun 2000.',
            'start_year.max' => 'Tahun awal tidak boleh lebih dari tahun ' . now()->year . '.',
            'end_year.min' => 'Tahun akhir tidak boleh kurang dari tahun 2000.',
            'end_year.max' => 'Tahun akhir tidak boleh lebih dari tahun ' . now()->year . '.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')
                ->with('validation_errors', $validator->errors()->all())
                ->with('error_type', 'validation')
                ->withInput();
        }

        $prodi = $request->input('prodi', '1'); // Default ke 1 (D4 TI) sebagai ID numerik
        $start_year = $request->input('start_year', now()->year - 3); // 2022
        $end_year = $request->input('end_year', now()->year ); // 2025

        if ($end_year < $start_year) {
            return redirect()->route('dashboard')
                ->with('validation_errors', ['Tahun akhir tidak boleh lebih kecil dari tahun awal'])
                ->with('error_type', 'validation')
                ->withInput();
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

        $kepuasanTableData = $this->getKepuasanTableData($prodi, $start_year, $end_year);

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
            'averageDays',
            'kepuasanTableData'
        ));
    }
    public function getKepuasanTableData($prodi, $start_year, $end_year)
    {
        $evaluationFields = [
            'kerjasama_tim' => 'Kerjasama Tim',
            'keahlian_it' => 'Keahlian di bidang TI',
            'kemampuan_bahasa_asing' => 'Kemampuan berbahasa asing (Inggris)',
            'kemampuan_komunikasi' => 'Kemampuan berkomunikasi',
            'pengembangan_diri' => 'Pengembangan diri',
            'kepemimpinan' => 'Kepemimpinan',
            'etos_kerja' => 'Etos Kerja'
        ];

        $tableData = [];
        $totalCounts = [0, 0, 0, 0, 0]; // Total untuk setiap skala (1-5)
        $grandTotal = 0;

        foreach ($evaluationFields as $field => $label) {
            // Query untuk mendapatkan data per field
            $fieldData = DB::table('t_kuisioner_stakeholder as ks')
                ->join('t_lulusan as l', 'ks.id_lulusan', '=', 'l.id_lulusan')
                ->where('l.id_program_studi', $prodi)
                ->whereRaw('YEAR(l.tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year])
                ->select($field, DB::raw('COUNT(*) as count'))
                ->groupBy($field)
                ->get()
                ->pluck('count', $field)
                ->toArray();

            // Hitung total untuk field ini
            $fieldTotal = array_sum($fieldData);
            $grandTotal += $fieldTotal;

            // Hitung count dan persentase untuk setiap skala
            $counts = [];
            $percentages = [];
            
            for ($i = 5; $i >= 1; $i--) { // Urutkan dari Sangat Baik (5) ke Sangat Kurang (1)
                $value = (string)$i;
                $count = isset($fieldData[$value]) ? $fieldData[$value] : 0;
                $counts[] = $count;
                $percentages[] = $fieldTotal > 0 ? round(($count / $fieldTotal) * 100, 2) : 0;
                
                // Tambahkan ke total counts
                $totalCounts[$i-1] += $count;
            }

            $tableData[] = [
                'label' => $label,
                'counts' => array_reverse($counts), // Balik urutan jadi 1,2,3,4,5
                'percentages' => array_reverse($percentages), // Balik urutan jadi 1,2,3,4,5
                'total' => $fieldTotal
            ];
        }

        // Hitung persentase total
        $totalPercentages = [];
        for ($i = 0; $i < 5; $i++) {
            $totalPercentages[] = $grandTotal > 0 ? round(($totalCounts[$i] / $grandTotal) * 100, 2) : 0;
        }

        return [
            'data' => $tableData,
            'totals' => [
                'counts' => $totalCounts,
                'percentages' => $totalPercentages,
                'grand_total' => $grandTotal
            ]
        ];
    }
    public function skalaInstansi(Request $request)
    {
        $prodi = $request->input('prodi', '1'); // Default ke 1 (D4 TI) sebagai ID numerik
        $start_year = $request->input('start_year', now()->year - 3); // 2022
        $end_year = $request->input('end_year', now()->year ); // 2025

        $query = DB::table('t_kuisioner_lulusan as k')
            ->join('t_lulusan as l', 'k.id_lulusan', '=', 'l.id_lulusan')
            ->select(
                DB::raw('YEAR(l.tanggal_lulus) as tahun_lulus'),
                DB::raw('COUNT(l.id_lulusan) AS jumlah_lulusan'),
                DB::raw('COUNT(k.id_kuisioner_lulusan) AS lulusan_terlacak'),
                DB::raw('SUM(CASE WHEN k.id_kategori_profesi = 1 THEN 1 ELSE 0 END) AS bidang_infokom'),
                DB::raw('SUM(CASE WHEN k.id_kategori_profesi = 2 THEN 1 ELSE 0 END) AS bidang_non_infokom'),
                DB::raw('SUM(CASE WHEN k.skala_instansi = "Multinasional/Internasional" THEN 1 ELSE 0 END) AS internasional'),
                DB::raw('SUM(CASE WHEN k.skala_instansi = "Nasional" THEN 1 ELSE 0 END) AS nasional'),
                DB::raw('SUM(CASE WHEN k.skala_instansi = "Wirausaha" THEN 1 ELSE 0 END) AS wirausaha')
            )
            ->whereNotNull('k.tanggal_pertama_berkerja')
            ->where('l.id_program_studi', $prodi)
            ->whereRaw('YEAR(l.tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year])
            ->groupBy(DB::raw('YEAR(l.tanggal_lulus)'));

        return DataTables::of($query)
            ->addColumn('tahun_lulus', function ($row) {
                return $row->tahun_lulus;
            })
            ->addColumn('jumlah_lulusan', function ($row) {
                return $row->jumlah_lulusan;
            })
            ->addColumn('lulusan_terlacak', function ($row) {
                return $row->lulusan_terlacak;
            })
            ->addColumn('bidang_infokom', function ($row) {
                return $row->bidang_infokom;
            })
            ->addColumn('bidang_non_infokom', function ($row) {
                return $row->bidang_non_infokom;
            })
            ->addColumn('internasional', function ($row) {
                return $row->internasional;
            })
            ->addColumn('nasional', function ($row) {
                return $row->nasional;
            })
            ->addColumn('wirausaha', function ($row) {
                return $row->wirausaha;
            })
            ->make(true);
    }
}
