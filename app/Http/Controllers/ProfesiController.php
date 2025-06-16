<?php

namespace App\Http\Controllers;

use App\Models\KategoriProfesiModel;
use App\Models\ProfesiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProfesiController extends Controller
{
    public function index()
    {
        $kategori = KategoriProfesiModel::select('id_kategori_profesi', 'nama_kategori')
        ->where('id_kategori_profesi', '!=', 3)
        ->get();

        return view('profesi.index', compact('kategori'));
    }
    public function list(Request $request)
    {
        $profesi = ProfesiModel::with('kategoriProfesi')->select('id_profesi', 'nama_profesi', 'id_kategori_profesi')
            ->where('nama_profesi', '!=', 'Lainnya....');

        $id_kategori_profesi = $request->input('filter_kategori');
        if (!empty($id_kategori_profesi)) {
            $profesi->where('id_kategori_profesi', $id_kategori_profesi);
        }

        return DataTables::of($profesi)
            ->addIndexColumn()
            ->addColumn('kategori', function ($row) {
                return $row->kategoriProfesi->nama_kategori;
            })
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="modalAction(\''.url('/profesi/' . $row->id_profesi . '/edit').'\')" class="btn btn-warning btn-sm mb-0">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/profesi/' . $row->id_profesi . '/delete').'\')" class="btn btn-danger btn-sm mb-0">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['action', 'kategori'])
            ->make(true);
    }
    public function create()
    {
        $kategori = KategoriProfesiModel::select('id_kategori_profesi', 'nama_kategori')
            ->where('id_kategori_profesi', '!=', 3)
            ->get();

        return view('profesi.create', compact('kategori'));
    }
    public function store(Request $request)
    {
        $rules = [
            'nama_profesi' => 'required|string|max:100',
            'id_kategori_profesi' => 'required|exists:t_kategori_profesi,id_kategori_profesi',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal, silakan periksa kembali inputan Anda.',
                'msgField' => $validator->errors(),
            ]);
        }

        ProfesiModel::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data profesi berhasil ditambahkan'
        ]);
    }
    public function edit($id)
    {
        $profesi = ProfesiModel::with('kategoriProfesi')->find($id);
        $kategori = KategoriProfesiModel::select('id_kategori_profesi', 'nama_kategori')
            ->where('id_kategori_profesi', '!=', 3)
            ->where('id_kategori_profesi', '!=', $profesi->id_kategori_profesi)
            ->get();

        return view('profesi.edit', compact('profesi', 'kategori'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_profesi' => 'required|string|max:100',
            'id_kategori_profesi' => 'required|exists:t_kategori_profesi,id_kategori_profesi',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal, silakan periksa kembali inputan Anda.',
                'msgField' => $validator->errors(),
            ]);
        }

        $profesi = ProfesiModel::find($id);
        $profesi->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data profesi berhasil diperbarui'
        ]);
    }
    public function confirmDelete($id)
    {
        $profesi = ProfesiModel::with('kategoriProfesi')->find($id);
        return view('profesi.delete', compact('profesi'));
    }
    public function destroy($id)
    {
        $profesi = ProfesiModel::find($id);
        $profesi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data profesi berhasil dihapus'
        ]);
    }
}
