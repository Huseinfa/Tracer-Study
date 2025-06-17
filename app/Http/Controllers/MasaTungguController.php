<?php

namespace App\Http\Controllers;

use App\Models\KuisionerLulusanModel;
use App\Models\LulusanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasaTungguController extends Controller
{
    public function index(Request $request)
    {
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
            return redirect()->route('masa-tunggu.index')
                ->with('validation_errors', $validator->errors()->all())
                ->with('error_type', 'validation')
                ->withInput();
        }

        $prodi = $request->input('prodi', '1'); // Default ke 1 (D4 TI) sebagai ID numerik
        $start_year = $request->input('start_year', now()->year - 3); // 2022
        $end_year = $request->input('end_year', now()->year ); // 2025

        if ($end_year < $start_year) {
            return redirect()->route('masa-tunggu.index')
                ->with('validation_errors', ['Tahun akhir tidak boleh lebih kecil dari tahun awal'])
                ->with('error_type', 'validation')
                ->withInput();
        }

        return view('masatunggu.index');
    }

    public function perLulusan(Request $request)
    {
        // Get filter inputs with defaults
        $prodi = $request->input('prodi', '1'); // Default to D4 TI
        $start_year = $request->input('start_year', now()->year - 3);
        $end_year = $request->input('end_year', now()->year );

        $query = KuisionerLulusanModel::with('lulusan')
            ->whereHas('lulusan', function ($q) use ($prodi, $start_year, $end_year) {
                $q->where('id_program_studi', $prodi)
                  ->whereRaw('YEAR(tanggal_lulus) BETWEEN ? AND ?', [$start_year, $end_year]);
            });

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('rataRata', function ($row) {
                if ($row->lulusan && $row->lulusan->tanggal_lulus && $row->tanggal_pertama_berkerja) {
                    $months = \Carbon\Carbon::parse($row->lulusan->tanggal_lulus)->diffInMonths($row->tanggal_pertama_berkerja);
                    $badgeClass = $months <= 3 ? 'success' : ($months <= 6 ? 'info' : ($months <= 12 ? 'warning' : 'danger'));
                    return '<span class="badge bg-' . $badgeClass . ' text-white">' . $months . ' bulan</span>';
                }
                return '<span class="badge bg-light text-dark">-</span>';
            })
            ->rawColumns(['rataRata'])
            ->make(true);
    }

    public function perTahun(Request $request)
    {
        // Get filter inputs with defaults
        $prodi = $request->input('prodi', '1'); // Default to D4 TI
        $start_year = $request->input('start_year', now()->year - 3);
        $end_year = $request->input('end_year', now()->year );

        $query = DB::table('t_kuisioner_lulusan as kl')
            ->join('t_lulusan as l', 'kl.id_lulusan', '=', 'l.id_lulusan')
            ->select(
                DB::raw('YEAR(l.tanggal_lulus) as tahun_lulus'),
                DB::raw('COUNT(l.id_lulusan) as jumlah_lulusan'),
                DB::raw('COUNT(kl.tanggal_pertama_berkerja) as jumlah_terlacak'),
                DB::raw('AVG(TIMESTAMPDIFF(MONTH, l.tanggal_lulus, kl.tanggal_pertama_berkerja)) as rataRata')
            )
            ->whereNotNull('kl.tanggal_pertama_berkerja')
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
            ->addColumn('jumlah_terlacak', function ($row) {
                return $row->jumlah_terlacak;
            })
            ->addColumn('rataRata', function ($row) {
                $months = round($row->rataRata, 1);
                $badgeClass = $months <= 3 ? 'success' : ($months <= 6 ? 'info' : ($months <= 12 ? 'warning' : 'danger'));
                return '<span class="badge bg-' . $badgeClass . ' text-white">' . $months . ' bulan</span>';
            })
            ->rawColumns(['tahun_lulus', 'jumlah_lulusan', 'jumlah_terlacak', 'rataRata'])
            ->make(true);
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