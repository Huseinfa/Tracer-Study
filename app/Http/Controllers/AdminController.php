<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AdminController extends Controller
{
    public function index()
    {
        $admins = UserModel::all();
        return view('admin.index', compact('admins'))->with('activePage', 'admin');
    }

    public function create()
    {
        return view('admin.create')->with('activePage', 'admin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:t_user,username',
            'nama_user' => 'required',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        UserModel::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function show($id_user)
    {
        $admin = UserModel::where('id_user', $id_user)->firstOrFail();
        return view('admin.show', compact('admin'))->with('activePage', 'admin');
    }

    public function edit($id_user)
    {
        $admin = UserModel::where('id_user', $id_user)->firstOrFail();
        return view('admin.edit', compact('admin'))->with('activePage', 'admin');
    }

    public function update(Request $request, $id_user)
    {
        $admin = UserModel::where('id_user', $id_user)->firstOrFail();

        $validated = $request->validate([
            'username' => 'required|unique:t_user,username,' . $id_user . ',id_user',
            'nama_user' => 'required',
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id_user)
    {
        $admin = UserModel::where('id_user', $id_user)->firstOrFail();
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
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