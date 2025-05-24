<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

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
}
