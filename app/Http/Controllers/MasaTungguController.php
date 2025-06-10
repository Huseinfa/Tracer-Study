<?php

namespace App\Http\Controllers;

use App\Models\LulusanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasaTungguController extends Controller
{
    public function index(Request $request)
    {
        // Determine which tab is active
        $tab = $request->input('tab', 'lulusan');
        
        // Get data for lulusan tab
        $search = $request->input('search');
        $query = LulusanModel::with(['kuisionerlulusan', 'prodi']);
        
        // Apply search filter for lulusan if search parameter exists
        if ($search) {
            $query->where('nama_lulusan', 'like', '%' . $search . '%');
        }
        
        $lulusan = $query->paginate(10);
        
        // Get data for rata-rata tab
        // Get the selected year from the request, default to null (no filter)
        $selectedYear = $request->input('year');

        // Fetch available years for the dropdown
        $years = LulusanModel::select(DB::raw('YEAR(tanggal_lulus) as tahun_lulus'))
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('tahun_lulus')
            ->toArray();

        // Build the query for aggregated data
        $rataRataQuery = LulusanModel::select(
            DB::raw('YEAR(tanggal_lulus) as tahun_lulus'),
            DB::raw('COUNT(*) as jumlah_lulusan'),
            DB::raw('SUM(CASE WHEN kuisionerlulusan.id_kuisioner_lulusan IS NOT NULL THEN 1 ELSE 0 END) as jumlah_terlacak'),
            DB::raw('AVG(TIMESTAMPDIFF(MONTH, tanggal_lulus, kuisionerlulusan.tanggal_pertama_berkerja)) as rata_rata_tunggu')
        )
        ->leftJoin('t_kuisioner_lulusan as kuisionerlulusan', 't_lulusan.id_lulusan', '=', 'kuisionerlulusan.id_lulusan')
        ->groupBy('tahun_lulus');

        // Apply the year filter if selected
        if ($selectedYear) {
            $rataRataQuery->whereYear('tanggal_lulus', $selectedYear);
        }

        $data = $rataRataQuery->get();

        // Calculate totals for rata-rata
        $totals = [
            'jumlah_lulusan' => $data->sum('jumlah_lulusan'),
            'jumlah_terlacak' => $data->sum('jumlah_terlacak'),
            'rata_rata_tunggu' => $data->avg('rata_rata_tunggu'),
        ];

        return view('masatunggu.index', compact('lulusan', 'data', 'totals', 'years', 'selectedYear', 'tab'));
    }

    // Keep these methods for backward compatibility
    public function lulusan(Request $request)
    {
        return redirect()->route('masa-tunggu', ['tab' => 'lulusan', 'search' => $request->input('search')]);
    }

    public function rataRata(Request $request)
    {
        return redirect()->route('masa-tunggu', ['tab' => 'ratarata', 'year' => $request->input('year')]);
    }
}