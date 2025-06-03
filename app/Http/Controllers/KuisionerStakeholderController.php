<?php

namespace App\Http\Controllers;

use App\Models\KuisionerStakeholderModel;
use App\Models\LulusanModel;
use App\Models\StakeholderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KuisionerStakeholderController extends Controller
{
    public function index($kode)
    {
        $validasi =  StakeholderModel::where('kode_atasan', $kode)->first();

        if ($validasi->sudah_mengisi != 0) { // jika stakeholder sudah pernah mengisi kuisioner
            return redirect()->route('survey-kepuasan.thanks')->with('info', 'Anda sudah pernah mengisi kuesioner.');
        }

        $stakeholder =  StakeholderModel::select('id_stakeholder', 'id_lulusan', 'nama_atasan', 'jabatan_atasan', 'email_atasan', 'kode_atasan', 'sudah_mengisi')
        ->with('lulusan')
        ->find($validasi->id_stakeholder);

        return view('kuisionerstakeholder.index', ['stakeholder' => $stakeholder]);
    }
    public function simpan(Request $request, $id)
    {
        $rules = [
            'nama_atasan' => 'required|string',
            'jabatan_atasan' => 'required|string',
            'kerjasama_tim' => 'required|in:1,2,3,4,5',
            'keahlian_it' => 'required|in:1,2,3,4,5',
            'kemampuan_bahasa_asing' => 'required|in:1,2,3,4,5',
            'kemampuan_komunikasi' => 'required|in:1,2,3,4,5',
            'pengembangan_diri' => 'required|in:1,2,3,4,5',
            'kepemimpinan' => 'required|in:1,2,3,4,5',
            'etos_kerja' => 'required|in:1,2,3,4,5',
            'kompetensi_yang_belum_dipenuhi' => 'required|string|max:255',
            'saran_kurikulum_prodi' => 'required|string|max:255',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->first(),
            ]);
        } else {
            $stakeholder = StakeholderModel::find($id);

            KuisionerStakeholderModel::create([
                'id_stakeholder' => $stakeholder->id_stakeholder,
                'id_lulusan' => $stakeholder->id_lulusan,
                'kerjasama_tim' => $request->input('kerjasama_tim'),
                'keahlian_it' => $request->input('keahlian_it'),
                'kemampuan_bahasa_asing' => $request->input('kemampuan_bahasa_asing'),
                'kemampuan_komunikasi' => $request->input('kemampuan_komunikasi'),
                'pengembangan_diri' => $request->input('pengembangan_diri'),
                'kepemimpinan' => $request->input('kepemimpinan'),
                'etos_kerja' => $request->input('etos_kerja'),
                'kompetensi_yang_belum_dipenuhi' => $request->input('kompetensi_yang_belum_dipenuhi'),
                'saran_kurikulum_prodi' => $request->input('saran_kurikulum_prodi'),
            ]);

            $stakeholder->update([
                'nama_atasan' => $request->input('nama_atasan'),
                'jabatan_atasan' => $request->input('jabatan_atasan'),
                'sudah_mengisi' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jawaban anda berhasil disimpan.',
                'redirect_url' => route('survey-kepuasan.thanks')
            ]);
        }
    }
    public function terimakasih()
    {
        return view('kuisionerstakeholder.thanks');
    }
}
