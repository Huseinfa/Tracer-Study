<?php

namespace App\Http\Controllers;

use App\Models\StakeholderModel;
use Illuminate\Http\Request;

class DataStakeholderController extends Controller
{
    public function index()
    {
        $stakeholders = StakeholderModel::all();
        return view('stakeholder.index', compact('stakeholders'))->with('activePage', 'stakeholder');
    }

    public function create()
    {
        return view('stakeholder.create')->with('activePage', 'stakeholder');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_atasan' => 'required',
            'instansi' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email|unique:t_stakeholder,email',
        ]);

        StakeholderModel::create($validated);
        return redirect()->route('stakeholder.index')->with('success', 'Stakeholder berhasil ditambahkan.');
    }

    public function show($id_stakeholder)
    {
        $stakeholder = StakeholderModel::where('id_stakeholder', $id_stakeholder)->firstOrFail();
        return view('stakeholder.show', compact('stakeholder'))->with('activePage', 'stakeholder');
    }

    public function edit($id_stakeholder)
    {
        $stakeholder = StakeholderModel::where('id_stakeholder', $id_stakeholder)->firstOrFail();
        return view('stakeholder.edit', compact('stakeholder'))->with('activePage', 'stakeholder');
    }

    public function update(Request $request, $id_stakeholder)
    {
        $stakeholder = StakeholderModel::where('id_stakeholder', $id_stakeholder)->firstOrFail();

        $validated = $request->validate([
            'nama_atasan' => 'required',
            'instansi' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email|unique:t_stakeholder,email,' . $stakeholder->id_stakeholder . ',id_stakeholder',
        ]);

        $stakeholder->update($validated);
        return redirect()->route('stakeholder.index')->with('success', 'Stakeholder berhasil diperbarui.');
    }

    public function destroy($id_stakeholder)
    {
        $stakeholder = StakeholderModel::where('id_stakeholder', $id_stakeholder)->firstOrFail();
        $stakeholder->delete();
        return redirect()->route('stakeholder.index')->with('success', 'Stakeholder berhasil dihapus.');
    }
}