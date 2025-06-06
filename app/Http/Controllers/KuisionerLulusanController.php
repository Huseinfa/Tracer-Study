<?php

namespace App\Http\Controllers;

use App\Mail\SendLinkMail;
use App\Mail\SendOtpMail;
use App\Models\JenisInstansiModel;
use App\Models\KategoriProfesiModel;
use App\Models\KodeLulusanModel;
use App\Models\KuisionerLulusanModel;
use App\Models\LulusanModel;
use App\Models\ProfesiModel;
use App\Models\StakeholderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class KuisionerLulusanController extends Controller
{
    /*
    *
    * halaman cari lulusan.
    *
    */

    public function index()
    {
        return view('kuisionerlulusan.index');
    }
    public function cari(Request $request)
    {
        $keyword = $request->input('teks');
        $lulusan = LulusanModel::where('nim', $keyword)
            ->orWhere('nama_lulusan', 'like', '%' . $keyword . '%')
            ->get();

        if ($lulusan->count() > 0) {
            return response()->json([
                'success' => true,
                'data' => $lulusan,
                'message' => 'Pilih data Anda dari daftar berikut.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data anda tidak ditemukan.',
            ]);
        }
    }

    /*
    *
    * halaman konfirmasi lulusan.
    *
    */

    public function kodeUnikLulusan()
    {
        do {
            $kode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $exists = KodeLulusanModel::where('kode_lulusan', $kode)->exists();
        } while ($exists);

        return $kode;
    }
    public function kembali() {
        session()->flush();
        return redirect()->route('tracer-study.index');
    }
    public function konfirmasi($id)
    {
        $lulusan = LulusanModel::select('id_program_studi', 'id_lulusan', 'nim', 'nama_lulusan', 'email_lulusan', 'no_hp_lulusan', 'tanggal_lulus', 'sudah_mengisi')
            ->with('prodi')
            ->find($id);

        session(['id_lulusan' => $lulusan->id_lulusan, 'sudah_mengisi' => $lulusan->sudah_mengisi]);
        
        return view('kuisionerlulusan.show', ['lulusan' => $lulusan]);
    }
    public function terkonfirmasi(Request $request, $id)
    {
        $rules = [
            'email_lulusan' => 'nullable|email|min:12|max:25',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Silakan periksa input Anda.',
                'errors' => $validator->errors(),
            ]);
        } else {
            $lulusan = LulusanModel::find($id);

            if (!$request->filled('email_lulusan')) {
                    $request->request->remove('email_lulusan');
            } else {
                $lulusan->update([
                    'email_lulusan' => $request->input('email_lulusan'),
                ]);
                
                $kodeLulusan = $this->kodeUnikLulusan();
        
                $updateKode = KodeLulusanModel::where('email', $lulusan->email_lulusan)->first();
        
                if ($updateKode) {
                    $updateKode->update([
                        'kode_lulusan' => $kodeLulusan,
                    ]);
                } else {
                    KodeLulusanModel::create([
                        'email' => $lulusan->email_lulusan,
                        'kode_lulusan' => $kodeLulusan,
                    ]);
                }
        
                Mail::to($lulusan->email_lulusan)->send(new SendOtpMail($kodeLulusan, $lulusan->nama_lulusan));
        
                return response()->json([
                    'success' => true,
                    'message' => 'Kode OTP telah dikirim, silahkan cek email anda (' . $lulusan->email_lulusan . ').',
                    'redirect_url' => route('tracer-study.otp', ['id' => $id])
                ]);
            }   
        }
    }

    /*
    *
    * halaman otp lulusan.
    *
    */

    public function kirimUlang($id) {
        $lulusan = LulusanModel::find($id);

        $kodeLulusan = $this->kodeUnikLulusan();

        $updateKode = KodeLulusanModel::where('email', $lulusan->email_lulusan)->first();

        $updateKode->update([
            'kode_lulusan' => $kodeLulusan,
        ]);
        
        Mail::to($lulusan->email_lulusan)->send(new SendOtpMail($kodeLulusan, $lulusan->nama_lulusan));

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP yang baru telah dikirim, silahkan cek email anda.',
        ]);
    }
    public function otp($id)
    {
        $lulusan = LulusanModel::find($id);
        return view('kuisionerlulusan.otp', ['lulusan' => $lulusan]);
    }
    public function verifikasi(Request $request, $id)
    {
        $rules = [
            'otp' => 'required|string|size:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Silakan periksa input Anda.',
                'errors' => $validator->errors(),
            ]);
        } else {
            $lulusan = LulusanModel::find($id);

            $kode = KodeLulusanModel::where('email', $lulusan->email_lulusan)
                ->where('kode_lulusan', $request->input('otp'))
                ->first();

            if ($kode) {
                session(['otp_verified' => true]);

                return response()->json([
                    'success' => true,
                    'message' => 'Verifikasi berhasil. Silakan isi kuesioner.',
                    'redirect_url' => route('tracer-study.kuisioner', ['id' => $id])
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode verifikasi tidak valid.',
                ]);
            }
        }
    }

    /*
    *
    * halaman kuisioner lulusan.
    *
    */

    public function kodeUnikStakeholder()
    {
        do {
            $kode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $exists = StakeholderModel::where('kode_atasan', $kode)->exists();
        } while ($exists);

        return $kode;
    }
    public function kuisioner($id)
    {
        $lulusan = LulusanModel::select('id_program_studi', 'id_lulusan', 'nim', 'nama_lulusan', 'email_lulusan', 'no_hp_lulusan', 'tanggal_lulus')
            ->with('prodi')
            ->find($id);

        $kategori = KategoriProfesiModel::select('id_kategori_profesi', 'nama_kategori')->get();

        $instansi = JenisInstansiModel::select('id_jenis_instansi', 'nama_jenis_instansi')->get();

        return view('kuisionerlulusan.kuisioner', ['lulusan' => $lulusan, 'kategori' => $kategori, 'instansi' => $instansi]);
    }
    public function getProfesi($id_kategori)
    {
        $profesi = ProfesiModel::where('id_kategori_profesi', $id_kategori)
            ->select('id_profesi', 'nama_profesi')
            ->get();

        return response()->json($profesi);
    }
    public function simpan(Request $request, $id)
    {
        $rules = [
            'id_kategori_profesi' => 'required|exists:t_kategori_profesi,id_kategori_profesi',
            'id_profesi' => 'required|exists:t_profesi,id_profesi',
            'id_jenis_instansi' => 'required|exists:t_jenis_instansi,id_jenis_instansi',
            'tanggal_pertama_berkerja' => 'required|date',
            'tanggal_berkerja_instansi_sekarang' => 'required|date',
            'nama_instansi' => 'required|string|max:255',
            'skala_instansi' => 'required|in:Nasional,Multinasional/Internasional,Wirausaha',
            'lokasi_instansi' => 'required|string|max:255',
            'nama_atasan' => 'required|string|max:255',
            'jabatan_atasan' => 'required|string|max:255',
            'email_atasan' => 'required|email|max:255',
            'bersedia_mengisi' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Silakan periksa input Anda.',
                'errors' => $validator->errors(),
            ]);
        } else {
            $lulusan = LulusanModel::find($id);
            $lulusan->update([
                'sudah_mengisi' => true,
            ]);

            KuisionerLulusanModel::create([
                'id_lulusan' => $id,
                'id_kategori_profesi' => $request->input('id_kategori_profesi'),
                'id_profesi' => $request->input('id_profesi'),
                'id_jenis_instansi' => $request->input('id_jenis_instansi'),
                'tanggal_pertama_berkerja' => $request->input('tanggal_pertama_berkerja'),
                'tanggal_berkerja_instansi_sekarang' => $request->input('tanggal_berkerja_instansi_sekarang'),
                'nama_instansi' => $request->input('nama_instansi'),
                'skala_instansi' => $request->input('skala_instansi'),
                'lokasi_instansi' => $request->input('lokasi_instansi'),
                'nama_atasan' => $request->input('nama_atasan'),
                'jabatan_atasan' => $request->input('jabatan_atasan'),
                'email_atasan' => $request->input('email_atasan'),
                'bersedia_mengisi' => $request->input('bersedia_mengisi'),
            ]);

            if ($request->input('bersedia_mengisi') === '1') {
                $kodeStakeholder = $this->kodeUnikStakeholder();

                StakeholderModel::create([
                    'id_lulusan' => $id,
                    'nama_atasan' => $request->input('nama_atasan'),
                    'jabatan_atasan' => $request->input('jabatan_atasan'),
                    'email_atasan' => $request->input('email_atasan'),
                    'kode_atasan' => $kodeStakeholder,
                    'sudah_mengisi' => false,
                ]);

                Mail::to($request->input('email_atasan'))->send(new SendLinkMail($kodeStakeholder, $request->input('nama_atasan')));
            } else {
                StakeholderModel::create([
                    'id_lulusan' => $id,
                    'nama_atasan' => $request->input('nama_atasan'),
                    'jabatan_atasan' => $request->input('jabatan_atasan'),
                    'email_atasan' => $request->input('email_atasan'),
                    'sudah_mengisi' => false,
                ]);
            }

            session()->flush();

            return response()->json([
                'success' => true,
                'message' => 'Jawaban anda berhasil disimpan.',
                'redirect_url' => route('tracer-study.thanks')
            ]);
        }
    }
    public function terimakasih()
    {
        return view('kuisionerlulusan.thanks');
    }
}
