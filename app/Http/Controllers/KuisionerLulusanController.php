<?php

namespace App\Http\Controllers;

use App\Models\LulusanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KuisionerLulusanController extends Controller
{
    public function index()
    {
        return view('kuisionerlulusan.index');
    }
    public function search(Request $request)
    {
        $rules = [
            'search' => 'required|string|min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $search = $request->input('search');

        $kuisionerLulusan = LulusanModel::where('nama_lulusan', 'LIKE', "%{$search}%")
            ->orWhere('nim', 'LIKE', "%{$search}%")
            ->get(['id_lulusan', 'nim', 'nama_lulusan', 'id_program_studi', 'tanggal_lulus']);

        return response()->json($kuisionerLulusan);
    }
}
