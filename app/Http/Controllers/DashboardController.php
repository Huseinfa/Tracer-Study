<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        return view('dashboard.index', compact(
            'labels', 'counts', 'percentages', 'total',
            'instansiLabels', 'instansiCounts', 'instansiPercentages', 'totalInstansi'
        ));
    }
}