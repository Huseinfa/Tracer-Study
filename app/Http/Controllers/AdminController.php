<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function list(Request $request)
    {
        $admin = UserModel::select('id_user', 'username', 'nama_user');

        return DataTables::of($admin)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="modalAction(\''.url('/admin/' . $row->id_user . '/edit').'\')" class="btn btn-warning btn-sm mb-0">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/admin/' . $row->id_user . '/delete').'\')" class="btn btn-danger btn-sm mb-0">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|string|min:3|max:30|unique:t_user,username',
            'nama_user' => 'required|string|min:3|max:30',
            'password' => 'required|min:6',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal, silakan periksa kembali inputan Anda.',
                'msgField' => $validator->errors(),
            ]);
        }
    
        UserModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data admin berhasil ditambahkan'
        ]);
    }

    public function edit($id)
    {
        $admin = UserModel::find($id);
        return view('admin.edit', compact('admin'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'required|string|min:3|max:30|unique:t_user,username,' . $id . ',id_user',
            'nama_user' => 'required|string|min:3|max:30',
            'password' => 'nullable|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal, silakan periksa kembali inputan Anda.',
                'msgField' => $validator->errors(),
            ]);
        }

        $admin = UserModel::find($id);
        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'Data admin tidak ditemukan.'
            ]);
        } else {
            if (!$request->filled('password')) {
                    $request->request->remove('password');
                    $admin->update($request->all());
            }
            
            $admin->update($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data admin berhasil diperbarui.'
            ]);
        }
    }

    public function confirmDelete($id)
    {
        $admin = UserModel::find($id);
        return view('admin.delete', compact('admin'));
    }
    public function destroy($id)
    {
        $admin = UserModel::find($id);
        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'Data admin tidak ditemukan.'
            ]);
        }

        $admin->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data admin berhasil dihapus.'
        ]);
    }

    public function export()
    {
        // Ambil data admin yang akan diekspor
        $admins = UserModel::select('id_user', 'username', 'nama_user')
            ->orderBy('id_user')
            ->get();

        // Load library PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID User');
        $sheet->setCellValue('C1', 'Username');
        $sheet->setCellValue('D1', 'Nama User');

        // Format header bold
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Isi data admin
        $no = 1;
        $baris = 2;
        foreach ($admins as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->id_user);
            $sheet->setCellValue('C' . $baris, $value->username);
            $sheet->setCellValue('D' . $baris, $value->nama_user);
            $baris++;
            $no++;
        }

        // Set auto size untuk kolom
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set title sheet
        $sheet->setTitle('Data Admin');

        // Generate filename
        $filename = 'Data_Admin_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Set header untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}