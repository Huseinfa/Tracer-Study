<?php

namespace App\Http\Controllers;

use App\Models\LulusanModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class LulusanController extends Controller
{
    // Tampilkan semua lulusan
    public function index()
    {
        $prodi = ProdiModel::select('id_program_studi', 'nama_prodi')->get();

        return view('lulusan.index', compact('prodi'));
    }

    public function list(Request $request)
    {
        $lulusan = LulusanModel::with('prodi')->select('id_lulusan', 'id_program_studi', 'nim', 'nama_lulusan', 'email_lulusan', 'no_hp_lulusan', 'tanggal_lulus', 'sudah_mengisi');

        $id_program_studi = $request->input('filter_prodi');
        if (!empty($id_program_studi)) {
            $lulusan->where('id_program_studi', $id_program_studi);
        }

        return DataTables::of($lulusan)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                if ($row->sudah_mengisi == 1) {
                    return '<span class="badge bg-success">Sudah Mengisi</span>';
                } else {
                    return '<span class="badge bg-warning">Belum Mengisi</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="modalAction(\''.url('/lulusan/' . $row->id_lulusan . '/show').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/lulusan/' . $row->id_lulusan . '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/lulusan/' . $row->id_lulusan . '/destroy').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    // Form tambah lulusan
    public function create()
    {
        $prodi = ProdiModel::all();
        return view('lulusan.create', compact('prodi'));
    }

    // Simpan data lulusan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_program_studi' => 'required|exists:t_program_studi,id_program_studi',
            'nim' => 'required|unique:t_lulusan,nim',
            'nama_lulusan' => 'required|string|max:255',
            'email_lulusan' => 'required|email|unique:t_lulusan,email_lulusan',
            'no_hp_lulusan' => 'required|string|max:20',
            'tanggal_lulus' => 'required|date',
        ]);

        $validated['sudah_mengisi'] = 0;

        // Handle upload foto
        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        LulusanModel::create($validated);

        return redirect()->route('lulusan.index')->with('success', 'Data lulusan berhasil ditambahkan.');
    }

    // Form edit lulusan
    public function edit($id)
    {
        $lulusan = LulusanModel::findOrFail($id);
        $prodi = ProdiModel::all();
        return view('lulusan.edit', compact('lulusan', 'prodi'));
    }

    // Simpan perubahan data lulusan
    public function update(Request $request, $id)
    {
        $lulusan = LulusanModel::findOrFail($id);

        $validated = $request->validate([
            'id_program_studi' => 'required|exists:t_program_studi,id_program_studi',
            'nim' => 'required|unique:t_lulusan,nim,' . $id . ',id_lulusan',
            'nama_lulusan' => 'required|string|max:255',
            'email_lulusan' => 'required|email|unique:t_lulusan,email_lulusan,' . $id . ',id_lulusan',
            'no_hp_lulusan' => 'required|string|max:20',
            'tanggal_lulus' => 'required|date',
            'foto_profil' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $validated['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $lulusan->update($validated);

        return redirect()->route('lulusan.index')->with('success', 'Data lulusan berhasil diperbarui.');
    }

    public function show($id)
    {
        $lulusan = LulusanModel::with('prodi')->findOrFail($id);
        return view('lulusan.show', compact('lulusan'));
    }

    // Hapus lulusan
    public function destroy($id)
    {
        $lulusan = LulusanModel::findOrFail($id);
        $lulusan->delete();

        return redirect()->route('lulusan.index')->with('success', 'Data lulusan berhasil dihapus.');
    }

    // Form import lulusan
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $path = $request->file('file')->store('temp');
        $filePath = storage_path('app/' . $path);
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        unset($rows[0]); // hilangkan header

        foreach ($rows as $row) {
            $validator = Validator::make([
                'nim' => $row[1],
                'email_lulusan' => $row[4],
            ], [
                'nim' => 'required|unique:t_lulusan,nim',
                'email_lulusan' => 'required|email|unique:t_lulusan,email_lulusan',
            ]);

            if ($validator->fails()) {
                continue;
            }

            $namaProdi = $row[3];
            $prodi = \App\Models\ProdiModel::where('nama_prodi', $namaProdi)->first();

            if (!$prodi) {
                continue; // skip jika prodi tidak ditemukan
            }

            $tanggalLulus = \Carbon\Carbon::parse($row[6])->format('Y-m-d');

            LulusanModel::create([
                'id_program_studi' => $prodi->id_program_studi,
                'nim' => $row[1],
                'nama_lulusan' => $row[2],
                'email_lulusan' => $row[4],
                'no_hp_lulusan' => $row[5],
                'tanggal_lulus' => $tanggalLulus,
                'sudah_mengisi' => 0,
            ]);
        }

        return redirect()->route('lulusan.index')->with('success', 'Data berhasil diimport.');
    }

    // Form export lulusan
    public function export(Request $request)
    {
        $format = $request->input('format', 'xlsx');
        $lulusan = LulusanModel::with('prodi')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->fromArray([
            'ID', 'NIM', 'Nama', 'Program Studi', 'email_lulusan', 'Nomor HP', 'Tanggal Lulus'
        ], NULL, 'A1');

        // Data
        $row = 2;
        foreach ($lulusan as $data) {
            $sheet->fromArray([
                $data->id_lulusan,
                $data->nim,
                $data->nama_lulusan,
                $data->prodi->nama_prodi ?? '',
                $data->email_lulusan,
                $data->no_hp_lulusan,
                $data->tanggal_lulus
            ], NULL, 'A' . $row++);
        }

        // Output
        $writerType = $format === 'csv' ? 'Csv' : 'Xlsx';
        $writer = IOFactory::createWriter($spreadsheet, $writerType);

        $filename = 'data_lulusan_' . date('Ymd_His') . '.' . $format;
        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }

}
