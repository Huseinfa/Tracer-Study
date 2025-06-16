<?php
namespace App\Http\Controllers;

use App\Models\KuisionerLulusanModel;
use App\Models\KuisionerStakeholderModel;
use App\Models\LulusanModel;
use App\Models\StakeholderModel;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }
    public function tracerStudy()
    {
        $kuisionerLulusan = KuisionerLulusanModel::with(['lulusan', 'lulusan.prodi', 'jenisInstansi', 'kategoriProfesi', 'profesi']);

        return DataTables::of($kuisionerLulusan)
            ->addIndexColumn()
            ->addColumn('masa_tunggu', function ($row) {
                if ($row->lulusan && $row->lulusan->tanggal_lulus && $row->tanggal_pertama_berkerja) {
                    $tanggalLulus = \Carbon\Carbon::parse($row->lulusan->tanggal_lulus);
                    $tanggalBekerja = \Carbon\Carbon::parse($row->tanggal_pertama_berkerja);
                    return $tanggalLulus->diffInMonths($tanggalBekerja) . ' bulan';
                }
                return '-';
            })
            ->addColumn('nama_prodi', function ($row) {
                return $row->lulusan->prodi->nama_prodi ?? '-';
            })
            ->addColumn('nama_jenis_instansi', function ($row) {
                return $row->jenisInstansi->nama_jenis_instansi ?? '-';
            })
            ->addColumn('nama_kategori', function ($row) {
                return $row->kategoriProfesi->nama_kategori ?? '-';
            })
            ->make(true);
    }
    public function kepuasanStakeholder()
    {
        $kuisionerStakeholder = KuisionerStakeholderModel::with(['stakeholder', 'stakeholder.lulusan']);

        return DataTables::of($kuisionerStakeholder)
            ->addIndexColumn()
            ->addColumn('nama_lulusan', function ($row) {
                return $row->stakeholder->lulusan->nama_lulusan ?? '-';
            })
            ->addColumn('nama_prodi', function ($row) {
                return $row->stakeholder->lulusan->prodi->nama_prodi ?? '-';
            })
            ->addColumn('tanggal_lulus', function ($row) {
                return $row->stakeholder->lulusan->tanggal_lulus;
            })
            ->make(true);
    }
    public function lulusanBelumMengisi()
    {
        $belumMengisi = LulusanModel::where('sudah_mengisi', 0)->with('prodi');
        
        return DataTables::of($belumMengisi)
            ->addIndexColumn()
            ->make(true);
    }
    public function stakeholderBelumMengisi()
    {
        $belumMengisi = StakeholderModel::where('sudah_mengisi', 0)
            ->where('kode_atasan', null)
            ->with('lulusan');

        return DataTables::of($belumMengisi)
            ->addIndexColumn()
            ->make(true);
    }
    public function exportLaporan()
    {
        // Direktori sementara untuk menyimpan file Excel
        $tempDir = storage_path('app/temp/');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Nama file ZIP
        $zipFileName = 'Laporan_Hasil_Tracer_Study_' . date('Ymd_His') . '.zip';
        $zipFilePath = $tempDir . $zipFileName;

        // Buat instance ZipArchive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Gagal membuat file ZIP');
        }

        // Daftar laporan dan nama file
        $reports = [
            'Rekap_Hasil_Tracer_Study_'. date('Ymd_His') .'.xlsx' => $this->rekapTracer(),
            'Rekap_Hasil_Survey_Kepuasan_Pengguna_Lulusan_'. date('Ymd_His') .'.xlsx' => $this->rekapSurvey(),
            'Rekap_Lulusan_Belum_Mengisi_Tracer_Study_'. date('Ymd_His') .'.xlsx' => $this->rekapLulusan(),
            'Rekap_Pengguna_Lulusan_Belum_Mengisi_Survey_'. date('Ymd_His') .'.xlsx' => $this->rekapStakeholder(),
        ];

        // Generate dan tambahkan setiap file Excel ke ZIP
        foreach ($reports as $fileName => $data) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($data['headings'], null, 'A1');
            $sheet->fromArray($data['collection']->toArray(), null, 'A2');

            $filePath = $tempDir . $fileName;
            $writer = new Xlsx($spreadsheet);
            $writer->save($filePath);

            $zip->addFile($filePath, $fileName);
        }

        // Tutup ZIP
        $zip->close();

        // Hapus file Excel sementara setelah ditambahkan ke ZIP
        foreach (array_keys($reports) as $fileName) {
            @unlink($tempDir . $fileName);
        }

        // Unduh file ZIP dan hapus setelah dikirim
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
    public function rekapTracer()
    {
        $data = KuisionerLulusanModel::with(['lulusan', 'lulusan.prodi', 'jenisInstansi', 'kategoriProfesi', 'profesi'])
        ->get()
        ->map(function ($item, $index) {
            $masaTunggu = '-';
            if ($item->lulusan && $item->lulusan->tanggal_lulus && $item->tanggal_pertama_berkerja) {
                $tanggalLulus = \Carbon\Carbon::parse($item->lulusan->tanggal_lulus);
                $tanggalBekerja = \Carbon\Carbon::parse($item->tanggal_pertama_berkerja);
                $masaTunggu = $tanggalLulus->diffInMonths($tanggalBekerja);
            }

            return [
                'no' => $index + 1,
                'nama_prodi' => $item->lulusan->prodi->nama_prodi ?? '-',
                'nim' => $item->lulusan->nim ?? '-',
                'nama_lulusan' => $item->lulusan->nama_lulusan ?? '-',
                'no_hp_lulusan' => $item->lulusan->no_hp_lulusan ?? '-',
                'email_lulusan' => $item->lulusan->email_lulusan ?? '-',
                'tanggal_lulus' => $item->lulusan && $item->lulusan->tanggal_lulus ?? '-',
                'tanggal_pertama_berkerja' => $item->tanggal_pertama_berkerja ?? '-',
                'masa_tunggu' => $masaTunggu ?? '-',
                'tanggal_berkerja_instansi_sekarang' => $item->tanggal_berkerja_instansi_sekarang ?? '-',
                'nama_jenis_instansi' => $item->jenisInstansi->nama_jenis_instansi ?? '-',
                'nama_instansi' => $item->nama_instansi ?? '-',
                'skala_instansi' => $item->skala_instansi ?? '-',
                'lokasi_instansi' => $item->lokasi_instansi ?? '-',
                'nama_kategori' => $item->kategoriProfesi->nama_kategori ?? '-',
                'nama_profesi' => $item->profesi->nama_profesi ?? '-',
                'nama_atasan' => $item->nama_atasan ?? '-',
                'jabatan_atasan' => $item->jabatan_atasan ?? '-',
                'email_atasan' => $item->email_atasan ?? '-',
            ];
        });
        return [
            'collection' => new Collection($data),
            'headings' => [
                'No',
                'Program Studi',
                'NIM',
                'Nama Lulusan',
                'No. HP',
                'Email',
                'Tanggal Lulus',
                'Tanggal Pertama Bekerja',
                'Masa Tunggu (Bulan)',
                'Tanggal Bekerja Instansi Sekarang',
                'Jenis Instansi',
                'Nama Instansi',
                'Skala Instansi',
                'Lokasi Instansi',
                'Kategori Profesi',
                'Nama Profesi',
                'Nama Atasan',
                'Jabatan Atasan',
                'Email Atasan'
            ],
        ];
    }
    public function rekapSurvey()
    {
        $data = KuisionerStakeholderModel::with(['stakeholder', 'stakeholder.lulusan'])
            ->get()
            ->map(function ($item, $index) {
                $ratingSurvey = function($rating) {
                    switch($rating) {
                        case 1: return 'Sangat Kurang';
                        case 2: return 'Kurang';
                        case 3: return 'Cukup';
                        case 4: return 'Baik';
                        case 5: return 'Sangat Baik';
                        default: return '-';
                    }
                };

                return [
                    'no' => $index + 1,
                    'nama_stakeholder' => $item->stakeholder->nama_atasan ?? '-',
                    'jabatan_stakeholder' => $item->stakeholder->jabatan_atasan ?? '-',
                    'email_stakeholder' => $item->stakeholder->email_atasan ?? '-',
                    'nama_lulusan' => $item->lulusan->nama_lulusan ?? '-',
                    'nama_prodi' => $item->lulusan->prodi->nama_prodi ?? '-',
                    'tanggal_lulus' => $item->lulusan->tanggal_lulus ?? '-',
                    'kerjasama_tim' => $ratingSurvey($item->kerjasama_tim),
                    'keahlian_it' => $ratingSurvey($item->keahlian_it),
                    'kemampuan_bahasa_asing' => $ratingSurvey($item->kemampuan_bahasa_asing),
                    'kemampuan_komunikasi' => $ratingSurvey($item->kemampuan_komunikasi),
                    'pengembangan_diri' => $ratingSurvey($item->pengembangan_diri),
                    'kepemimpinan' => $ratingSurvey($item->kepemimpinan),
                    'etos_kerja' => $ratingSurvey($item->etos_kerja),
                    'kompetensi_yang_belum_dipenuhi' => $item->kompetensi_yang_belum_dipenuhi ?? '-',
                    'saran_kurikulum_prodi' => $item->saran_kurikulum_prodi ?? '-',
                ];
            });
        return [
            'collection' => new Collection($data),
            'headings' => [
                'No',
                'Nama Stakeholder',
                'Jabatan Stakeholder',
                'Email Stakeholder',
                'Nama Alumni',
                'Program Studi',
                'Tanggal Lulus',
                'Kerjasama Tim',
                'Keahlian IT',
                'Kemampuan Bahasa Asing',
                'Kemampuan Komunikasi',
                'Pengembangan Diri',
                'Kepemimpinan',
                'Etos Kerja',
                'Kompetensi yang Belum Dipenuhi',
                'Saran Kurikulum Prodi'
            ],
        ];
    }
    public function rekapLulusan()
    {
        $data = LulusanModel::with('prodi')
            ->where('sudah_mengisi', 0)
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'nama_prodi' => $item->prodi->nama_prodi ?? '-',
                    'nim' => $item->nim ?? '-',
                    'nama_lulusan' => $item->nama_lulusan ?? '-',
                    'no_hp_lulusan' => $item->no_hp_lulusan ?? '-',
                    'email_lulusan' => $item->email_lulusan ?? '-',
                    'tanggal_lulus' => $item->tanggal_lulus ?? '-',
                ];
            });
        return [
            'collection' => new Collection($data),
            'headings' => [
                'No',
                'Program Studi',
                'NIM',
                'Nama Lulusan',
                'No. HP',
                'Email',
                'Tanggal Lulus'
            ],
        ];
    }
    public function rekapStakeholder()
    {
        $data = StakeholderModel::where('sudah_mengisi', 0)
            ->where('kode_atasan', null)
            ->with('lulusan')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'no' => $index + 1,
                    'nama_atasan' => $item->nama_atasan ?? '-',
                    'jabatan_atasan' => $item->jabatan_atasan ?? '-',
                    'email_atasan' => $item->email_atasan ?? '-',
                    'nama_lulusan' => $item->lulusan->nama_lulusan ?? '-',
                    'nama_prodi' => $item->lulusan->prodi->nama_prodi ?? '-',
                    'tanggal_lulus' => $item->lulusan->tanggal_lulus ?? '-',
                ];
            });
        return [
            'collection' => new Collection($data),
            'headings' => [
                'No',
                'Nama Atasan',
                'Jabatan Atasan',
                'Email Atasan',
                'Nama Lulusan',
                'Program Studi',
                'Tanggal Lulus',
            ],
        ];
    }
}