<?php

namespace App\Http\Controllers;

use App\Models\StakeholderModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class StakeholderController extends Controller
{
    public function index()
    {
        return view('stakeholder.index');
    }

    public function list(Request $request)
    {
        $stakeholder = StakeholderModel::with('lulusan')->select('id_stakeholder', 'nama_atasan', 'jabatan_atasan', 'email_atasan', 'id_lulusan', 'kode_atasan', 'sudah_mengisi');

        return DataTables::of($stakeholder)
        ->addIndexColumn()
        ->addColumn('status', function ($row) {
            if ($row->sudah_mengisi == 1 && $row->kode_atasan != null) {
                return '<span class="badge bg-success">Sudah Mengisi</span>';
            } elseif ($row->sudah_mengisi == 0 && $row->kode_atasan != null) {
                return '<span class="badge bg-warning">Belum Mengisi</span>';
            } else {
                return '<span class="badge bg-danger">Tidak Bersedia Mengisi</span>';
            }
        })
        ->rawColumns(['status'])
        ->make(true);
    }

    public function show($id_stakeholder)
    {
        $stakeholder = StakeholderModel::where('id_stakeholder', $id_stakeholder)->firstOrFail();
        return view('stakeholder.show', compact('stakeholder'))->with('activePage', 'stakeholder');
    }

public function export()
{
    // Ambil data stakeholder
    $stakeholders = StakeholderModel::select(
        'id_stakeholder',
        'id_lulusan',
        'nama_atasan',
        'jabatan_atasan',
        'email_atasan',
        'kode_atasan',
        'sudah_mengisi'
    )
    ->orderBy('id_stakeholder')
    ->get();

    // Load library PhpSpreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header kolom
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'ID Stakeholder');
    $sheet->setCellValue('C1', 'ID Lulusan');
    $sheet->setCellValue('D1', 'Nama Atasan');
    $sheet->setCellValue('E1', 'Jabatan Atasan');
    $sheet->setCellValue('F1', 'Email Atasan');
    $sheet->setCellValue('G1', 'Kode Atasan');
    $sheet->setCellValue('H1', 'Sudah Mengisi');

    // Format header bold
    $sheet->getStyle('A1:H1')->getFont()->setBold(true);

    // Isi data stakeholder
    $no = 1;
    $baris = 2;
    foreach ($stakeholders as $value) {
        $sheet->setCellValue('A' . $baris, $no);
        $sheet->setCellValue('B' . $baris, $value->id_stakeholder);
        $sheet->setCellValue('C' . $baris, $value->id_lulusan);
        $sheet->setCellValue('D' . $baris, $value->nama_atasan);
        $sheet->setCellValue('E' . $baris, $value->jabatan_atasan);
        $sheet->setCellValue('F' . $baris, $value->email_atasan);
        $sheet->setCellValue('G' . $baris, $value->kode_atasan);
        // Tampilkan 'Ya' atau 'Tidak' untuk boolean sudah_mengisi
        $sheet->setCellValue('H' . $baris, $value->sudah_mengisi ? 'Ya' : 'Tidak');

        $baris++;
        $no++;
    }

    // Set auto size untuk kolom
    foreach (range('A', 'H') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Set title sheet
    $sheet->setTitle('Data Stakeholder');

    // Generate filename
    $filename = 'Data_Stakeholder_' . date('Y-m-d_H-i-s') . '.xlsx';

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