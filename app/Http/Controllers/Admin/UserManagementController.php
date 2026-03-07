<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
        public function index()
    {
        $admins = \App\Models\User::where('role', 'admin')->get();
        $petugas = \App\Models\User::where('role', 'petugas')->get();
        $users = \App\Models\User::where('role', 'user')->get();

        return view('admin.users.index', compact('admins', 'petugas', 'users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:user,petugas',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Akun berhasil ditambahkan');
    }

    public function edit(User $user)
{
    if ($user->role === 'admin') {
        abort(403);
    }

    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    if ($user->role === 'admin') {
        abort(403);
    }

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('admin.users')
        ->with('success', 'Akun berhasil diperbarui');
}

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus');
    }

    public function show(User $user)
{
    // Admin tidak boleh diakses
    if ($user->role === 'admin') {
        abort(403);
    }

    return view('admin.users.show', compact('user'));
}
}
