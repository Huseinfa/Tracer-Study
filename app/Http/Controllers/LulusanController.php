<?php

namespace App\Http\Controllers;

use App\Models\LulusanModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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
                $btn = '<button onclick="modalAction(\''.url('/lulusan/' . $row->id_lulusan . '/show').'\')" class="btn btn-info btn-sm mb-0">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/lulusan/' . $row->id_lulusan . '/edit').'\')" class="btn btn-warning btn-sm mb-0">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/lulusan/' . $row->id_lulusan . '/delete').'\')" class="btn btn-danger btn-sm mb-0">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        $prodi = ProdiModel::select('id_program_studi', 'nama_prodi')->get();
        return view('lulusan.create', compact('prodi'));
    }
    public function store(Request $request)
    {
        $rules = [
            'id_program_studi' => 'required|exists:t_program_studi,id_program_studi',
            'nim' => 'required|unique:t_lulusan,nim',
            'nama_lulusan' => 'required|string|max:30',
            'email_lulusan' => 'required|email',
            'no_hp_lulusan' => 'required|string|max:20',
            'tanggal_lulus' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal, silakan periksa kembali inputan Anda.',
                'msgField' => $validator->errors(),
            ]);
        }

        LulusanModel::create([
            'id_program_studi' => $request->input('id_program_studi'),
            'nim' => $request->input('nim'),
            'nama_lulusan' => $request->input('nama_lulusan'),
            'email_lulusan' => $request->input('email_lulusan'),
            'no_hp_lulusan' => $request->input('no_hp_lulusan'),
            'tanggal_lulus' => Carbon::parse($request->input('tanggal_lulus'))->format('Y-m-d'),
            'sudah_mengisi' => 0, // default belum mengisi
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data lulusan berhasil ditambahkan'
        ]);
    }

    // Form edit lulusan
    public function edit($id)
    {
        $lulusan = LulusanModel::find($id);
        $prodi = ProdiModel::where('id_program_studi', '!=', $lulusan->id_program_studi)
            ->select('id_program_studi', 'nama_prodi')
            ->get();
        return view('lulusan.edit', compact('lulusan', 'prodi'));
    }

    // Simpan perubahan data lulusan
    public function update(Request $request, $id)
    {
        $rules = [
            'id_program_studi' => 'required|exists:t_program_studi,id_program_studi',
            'nim' => 'required|unique:t_lulusan,nim,' . $id . ',id_lulusan',
            'nama_lulusan' => 'required|string|max:30',
            'email_lulusan' => 'required|email',
            'no_hp_lulusan' => 'required|string|max:20',
            'tanggal_lulus' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal, silakan periksa kembali inputan Anda.',
                'msgField' => $validator->errors(),
            ]);
        }

        $lulusan = LulusanModel::find($id);
        if (!$lulusan) {
            return response()->json([
                'status' => false,
                'message' => 'Data lulusan tidak ditemukan.'
            ]);
        }

        $lulusan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data lulusan berhasil diperbarui'
        ]);

    }

    public function show($id)
    {
        $lulusan = LulusanModel::with('prodi')->find($id);
        return view('lulusan.show', compact('lulusan'));
    }

    public function confirmDelete($id)
    {
        $lulusan = LulusanModel::with('prodi')->find($id);
        return view('lulusan.delete', compact('lulusan'));
    }
    public function destroy($id)
    {
        $lulusan = LulusanModel::find($id);
        if (!$lulusan) {
            return response()->json([
                'status' => false,
                'message' => 'Data lulusan tidak ditemukan.'
            ]);
        }

        $lulusan->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data lulusan berhasil dihapus.'
        ]);
    }

    // Form import lulusan
    public function import()
    {
        return view('lulusan.import');
    }

        public function storeImport(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    $path = $request->file('file')->store('temp');
    $filePath = storage_path('app/' . $path);
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    unset($rows[0]); // Remove header row

    $importedCount = 0;
    $skippedCount = 0;

    foreach ($rows as $index => $row) {
        Log::info('Processing row ' . ($index + 1), $row);

        $validator = Validator::make([
            'nim' => $row[1],
            'email_lulusan' => $row[4],
        ], [
            'nim' => 'required|unique:t_lulusan,nim',
            'email_lulusan' => 'required|email|unique:t_lulusan,email_lulusan',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for row ' . ($index + 1), [
                'row' => $row,
                'errors' => $validator->errors()->all()
            ]);
            $skippedCount++;
            continue;
        }

        $namaProdi = trim($row[3]); // Trim to avoid space issues
        $prodi = ProdiModel::where('nama_prodi', $namaProdi)->first();

        if (!$prodi) {
            Log::warning('Program Studi not found for row ' . ($index + 1), ['nama_prodi' => $namaProdi]);
            $skippedCount++;
            continue;
        }

        try {
            $tanggalLulus = \Carbon\Carbon::parse($row[6])->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error('Date parsing failed for row ' . ($index + 1), [
                'date' => $row[6],
                'error' => $e->getMessage()
            ]);
            $skippedCount++;
            continue;
        }

        try {
            LulusanModel::create([
                'id_program_studi' => $prodi->id_program_studi,
                'nim' => $row[1],
                'nama_lulusan' => $row[2],
                'email_lulusan' => $row[4],
                'no_hp_lulusan' => $row[5],
                'tanggal_lulus' => $tanggalLulus,
                'sudah_mengisi' => 0,
            ]);
            $importedCount++;
            Log::info('Successfully inserted row ' . ($index + 1));
        } catch (\Exception $e) {
            Log::error('Insertion failed for row ' . ($index + 1), [
                'row' => $row,
                'error' => $e->getMessage()
            ]);
            $skippedCount++;
        }
    }

    File::delete($filePath);

    return response()->json([
        'status' => true,
        'message' => "Data processed. {$importedCount} records imported, {$skippedCount} skipped."
    ]);
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
