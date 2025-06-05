<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LulusanModel;
use App\Models\StakeholderModel;
use App\Models\ProdiModel;
use App\Models\ProfesiModel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Join with t_profesi to get profession names and count occurrences
        $profesiData = DB::table('t_kuisioner_lulusan')
            ->join('t_profesi', 't_kuisioner_lulusan.id_profesi', '=', 't_profesi.id_profesi')
            ->select('t_profesi.nama_profesi as profesi', DB::raw('COUNT(*) as count'))
            ->groupBy('t_profesi.nama_profesi')
            ->orderBy('count', 'desc')
            ->get();
        
        // Calculate total for percentage
        $total = $profesiData->sum('count');
        
        // Most common profession
        $mostCommonProfesi = $profesiData->first();
        
        if ($total > 0) {
            // Get top 10 professions
            $topProfesi = $profesiData->take(10);
            
            // Calculate the sum of remaining professions (others)
            $otherCount = $total - $topProfesi->sum('count');
            
            // Prepare data for chart
            $labels = $topProfesi->pluck('profesi')->toArray();
            $counts = $topProfesi->pluck('count')->toArray();
            
            // Add "Lainnya" category if there are more professions
            if ($otherCount > 0) {
                $labels[] = 'Lainnya';
                $counts[] = $otherCount;
            }
            
            // Calculate percentages
            $percentages = array_map(function($count) use ($total) {
                return round(($count / $total) * 100, 1);
            }, $counts);
        } else {
            $labels = [];
            $counts = [];
            $percentages = [];
        }

        // Join with t_jenis_instansi to get institution types and count occurrences
        $instansiData = DB::table('t_kuisioner_lulusan')
            ->join('t_jenis_instansi', 't_kuisioner_lulusan.id_jenis_instansi', '=', 't_jenis_instansi.id_jenis_instansi')
            ->select('t_jenis_instansi.nama_jenis_instansi as instansi', DB::raw('COUNT(*) as count'))
            ->groupBy('t_jenis_instansi.nama_jenis_instansi')
            ->orderBy('count', 'desc')
            ->get();
        
        // Calculate total for institution type percentage
        $totalInstansi = $instansiData->sum('count');
        
        if ($totalInstansi > 0) {
            // Prepare data for institution types chart
            $instansiLabels = $instansiData->pluck('instansi')->toArray();
            $instansiCounts = $instansiData->pluck('count')->toArray();
            
            // Calculate percentages for institution types
            $instansiPercentages = array_map(function($count) use ($totalInstansi) {
                return round(($count / $totalInstansi) * 100, 1);
            }, $instansiCounts);
        } else {
            $instansiLabels = [];
            $instansiCounts = [];
            $instansiPercentages = [];
        }
        
        // Calculate average waiting time (masa tunggu)
        $avgWaitingTime = DB::table('t_kuisioner_lulusan')
            ->join('t_lulusan', 't_kuisioner_lulusan.id_lulusan', '=', 't_lulusan.id_lulusan')
            ->select(
                DB::raw('AVG(DATEDIFF(t_kuisioner_lulusan.tanggal_pertama_berkerja, t_lulusan.tanggal_lulus)) as avg_days')
            )
            ->first();
            
        $averageDays = $avgWaitingTime ? round($avgWaitingTime->avg_days) : 0;
        
        // Format the average waiting time
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
        
        // Get stakeholder evaluation data (for 7 criteria)
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
                ->select($field, DB::raw('COUNT(*) as count'))
                ->groupBy($field)
                ->get()
                ->pluck('count', $field)
                ->toArray();
            
            $counts = [];
            $total = array_sum($fieldData);
            
            // Initialize counts array with zeros for all possible values (1-5)
            for ($i = 1; $i <= 5; $i++) {
                $value = (string)$i;  // The values are stored as strings in the database
                $counts[$i-1] = isset($fieldData[$value]) ? $fieldData[$value] : 0;
            }
            
            // Calculate percentages
            $percentages = $total > 0 ? array_map(function($count) use ($total) {
                return round(($count / $total) * 100, 1);
            }, $counts) : [0, 0, 0, 0, 0];
            
            $evaluationData[$field] = [
                'title' => $label,
                'counts' => $counts,
                'percentages' => $percentages,
                'total' => $total
            ];
        }
        
        $lulusanCount = LulusanModel::count();
        $stakeholderCount = StakeholderModel::count();
        $prodiCount = ProdiModel::count();
        $profesiCount = ProfesiModel::count();
        $lulusanFilled = LulusanModel::where('sudah_mengisi', true)->count();
        $lulusanNotFilled = $lulusanCount - $lulusanFilled;
        $lulusanFilledPercentage = $lulusanCount > 0 ? round(($lulusanFilled / $lulusanCount) * 100, 2) : 0;
        $recentLulusan = LulusanModel::orderBy('created_at', 'desc')->limit(5)->get();

        return view('dashboard.index', compact(
            'labels', 'counts', 'percentages', 'total',
            'instansiLabels', 'instansiCounts', 'instansiPercentages', 'totalInstansi',
            'evaluationData', 'evaluationLabels',
            'lulusanCount', 'stakeholderCount', 'prodiCount', 'profesiCount',
            'lulusanFilledPercentage', 'recentLulusan', 'lulusanFilled', 'lulusanNotFilled',
            'averageWaitingTime', 'mostCommonProfesi', 'averageDays'
        ));
    }
}