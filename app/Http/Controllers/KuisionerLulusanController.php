<?php

namespace App\Http\Controllers;

use App\Models\KategoriProfesiModel;
use App\Models\KodeLulusanModel;
use App\Models\KuisionerLulusanModel;
use App\Models\LulusanModel;
use App\Models\ProfesiModel;
use App\Models\StakeholderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KuisionerLulusanController extends Controller
{
    public function index()
    {
        return view('kuisionerlulusan.index');
    }
    public function cari(Request $request)
    {
        $rules = [
            'teks' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cari data berdasarkan NIM atau Nama
        $keyword = $request->input('teks');
        $lulusan = LulusanModel::where('nim', $keyword)
                    ->orWhere('nama_lulusan', 'like', '%' . $keyword . '%')
                    ->first();

        if ($lulusan && $lulusan->id_lulusan) {
            return redirect()->route('tracer-study.konfirmasi', ['id' => $lulusan->id_lulusan]);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
    public function konfirmasi($id)
    {
        $lulusan = LulusanModel::select('id_program_studi', 'id_lulusan', 'nim', 'nama_lulusan', 'email', 'nomor_hp', 'tanggal_lulus')
        ->with('prodi')
        ->find($id);
        return view('kuisionerlulusan.show', ['lulusan' => $lulusan]);
    }
    public function buatKodeUnik()
    {
        do {
            $kode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $exists = KodeLulusanModel::where('kode_lulusan', $kode)->exists();
        } while ($exists);

        return $kode;
    }
    public function terkonfirmasi($id)
    {
        $lulusan = LulusanModel::findOrFail($id);
        $kodeVerifikasi = $this->buatKodeUnik();

        $existingKode = KodeLulusanModel::where('email', $lulusan->email)->first();

        if ($existingKode) {
            $existingKode->update([
                'kode_lulusan' => $kodeVerifikasi,
            ]);
        } else {
            KodeLulusanModel::create([
                'email' => $lulusan->email,
                'kode_lulusan' => $kodeVerifikasi,
            ]);
        }

        return redirect()->route('tracer-study.otp', ['id' => $id])
            ->with('success', 'Kode verifikasi telah dibuat atau diperbarui.');
    }
    public function otp($id)
    {
        $lulusan = LulusanModel::find($id);
        return view('kuisionerlulusan.otp', ['lulusan' => $lulusan]);
    }
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $lulusan = LulusanModel::findOrFail($id);

        $kode = KodeLulusanModel::where('email', $lulusan->email)
            ->where('kode_lulusan', $request->input('otp'))
            ->first();

        if ($kode) {
            return redirect()->route('tracer-study.kuisioner', ['id' => $id])
                ->with('success', 'Verifikasi berhasil. Silakan isi kuesioner.');
        } else {
            return redirect()->back()
                ->with('error', 'Kode verifikasi tidak valid.')
                ->withInput();
        }
    }
    public function kuisioner($id)
    {
        $lulusan = LulusanModel::select('id_program_studi', 'id_lulusan', 'nim', 'nama_lulusan', 'email', 'nomor_hp', 'tanggal_lulus')
        ->with('prodi')
        ->find($id);

        $kategori = KategoriProfesiModel::select('id_kategori_profesi', 'nama_kategori')->get();

        $profesi = ProfesiModel::select('id_profesi', 'nama_profesi')->get();

        return view('kuisionerlulusan.kuisioner', ['lulusan' => $lulusan, 'kategori' => $kategori, 'profesi' => $profesi]);
    }
    public function simpan(Request $request, $id)
    {
        $rules = [
            'nim' => 'required|string|max:50',
            'nama_lulusan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|string|max:20',
            'tanggal_lulus' => 'required|date',
            'id_kategori_profesi' => 'required|exists:t_kategori_profesi,id_kategori_profesi',
            'id_profesi' => 'required|exists:t_profesi,id_profesi',
            'tanggal_pertama_berkerja' => 'required|date',
            'tanggal_berkerja_instansi_sekarang' => 'required|date',
            'jenis_instansi' => 'required|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'skala_instansi' => 'required|in:Nasional,Multinasional/Internasional,Wirausaha',
            'lokasi_instansi' => 'required|string|max:255',
            'nama_atasan' => 'nullable|string|max:255',
            'jabatan_atasan' => 'nullable|string|max:255',
            'email_atasan' => 'nullable|email|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $lulusan = LulusanModel::find($id);
        $lulusan->update([
            'nim' => $request->input('nim'),
            'nama_lulusan' => $request->input('nama_lulusan'),
            'email' => $request->input('email'),
            'nomor_hp' => $request->input('nomor_hp'),
            'tanggal_lulus' => $request->input('tanggal_lulus'),
        ]);

        KuisionerLulusanModel::create([
            'id_lulusan' => $id,
            'id_kategori_profesi' => $request->input('id_kategori_profesi'),
            'id_profesi' => $request->input('id_profesi'),
            'tanggal_pertama_berkerja' => $request->input('tanggal_pertama_berkerja'),
            'tanggal_berkerja_instansi_sekarang' => $request->input('tanggal_berkerja_instansi_sekarang'),
            'jenis_instansi' => $request->input('jenis_instansi'),
            'nama_instansi' => $request->input('nama_instansi'),
            'skala_instansi' => $request->input('skala_instansi'),
            'lokasi_instansi' => $request->input('lokasi_instansi'),
            'nama_atasan' => $request->input('nama_atasan'),
            'jabatan_atasan' => $request->input('jabatan_atasan'),
            'email_atasan' => $request->input('email_atasan'),
        ]);

        StakeholderModel::create([
            'nama_atasan' => $request->input('nama_atasan'),
            'instansi' => $request->input('nama_instansi'),
            'jabatan' => $request->input('jabatan_atasan'),
            'email' => $request->input('email_atasan'),
        ]);

        return redirect()->route('tracer-study.index')->with('success', 'Kuisioner lulusan berhasil disimpan. Terima kasih telah berpartisipasi dalam tracer study kami.');
    }
}
