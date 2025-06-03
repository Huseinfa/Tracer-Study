<?php

namespace App\Http\Controllers;

use App\Models\LulusanModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;

class LulusanController extends Controller
{
    // Tampilkan semua lulusan
    public function index()
    {
    $lulusan = LulusanModel::with('prodi')->get();
    return view('lulusan.index', compact('lulusan'));
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
            'email' => 'required|email|unique:t_lulusan,email',
            'nomor_hp' => 'required|string|max:20',
            'tahun_lulus' => 'required|date',
            'foto_profil' => 'nullable|image|max:2048',
        ]);

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
            'email' => 'required|email|unique:t_lulusan,email,' . $id . ',id_lulusan',
            'nomor_hp' => 'required|string|max:20',
            'tahun_lulus' => 'required|date',
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
}
