<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OBController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:isAdmin');
    }

    public function index()
    {
        return view('pages.admin.ob.index', [
            'title' => 'Master Office Boy',
            'users' => User::where('role', '!=', 'admin')->get(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.ob.create', [
            'title' => 'Tambah Data Office-Boy',
            'user' => new User,
            'textButton' => 'Tambah'
        ]);
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.ob.index')
        ->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $user)
    {
        return view('pages.admin.ob.edit', [
            'title' => 'Edit Data Office-Boy',
            'user' => $user,
            'textButton' => 'Update'
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            //'password' => Hash::make('123'),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.ob.index')
        ->with('success', 'Berhasil Update Data');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.ob.index')
        ->with('success', 'Berhasil Delete Data');
    }
}
