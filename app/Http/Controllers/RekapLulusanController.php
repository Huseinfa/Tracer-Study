<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class RekapLulusanController extends Controller
{
    public function index()
    {
        $data = DB::table('t_lulusan')
            ->leftJoin('t_kuisioner_lulusan', 't_lulusan.id_lulusan', '=', 't_kuisioner_lulusan.id_lulusan')
            ->selectRaw('
                YEAR(t_lulusan.tanggal_lulus) as tahun,
                COUNT(t_lulusan.id_lulusan) as jumlah_lulusan,
                COUNT(t_kuisioner_lulusan.id_lulusan) as terlacak,
                SUM(CASE WHEN t_kuisioner_lulusan.id_kategori_profesi = 1 THEN 1 ELSE 0 END) as bidang_infokom,
                SUM(CASE WHEN t_kuisioner_lulusan.id_kategori_profesi = 2 THEN 1 ELSE 0 END) as non_infokom,
                SUM(CASE WHEN t_kuisioner_lulusan.skala_instansi = "Multinasional" THEN 1 ELSE 0 END) as multinasional,
                SUM(CASE WHEN t_kuisioner_lulusan.skala_instansi = "Nasional" THEN 1 ELSE 0 END) as nasional,
                SUM(CASE WHEN t_kuisioner_lulusan.skala_instansi = "Wirausaha" THEN 1 ELSE 0 END) as wirausaha
            ')
            ->groupByRaw('YEAR(t_lulusan.tanggal_lulus)')
            ->orderByRaw('tahun ASC')
            ->get();

        return view('rekap.index', compact('data'));
    }
}