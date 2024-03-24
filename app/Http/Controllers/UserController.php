<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.user.index', [
            'title' => 'Kelola User',
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        User::create([
            'nama'  => $request->nama,
            'email'  => $request->email,
            'password'  => Hash::make($request->password),
            'role'  => $request->role,
        ]);
        Alert::success('Berhasil', 'Tambah User Berhasil!');
        return redirect()->to('/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('admin.user.edit', [
            'title' => 'Edit User',
            'user'  =>  User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user, string $id)
    {
        //
        $data = [
            'id'    => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
        if ($request->password == null) {
            unset($data['password']);
        }
        $user = $user->findOrFail($id);
        $user->update($data);
        Alert::success('Berhasil', 'User Berhasil Diedit!');
        return redirect()->to('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Berhasil', 'User Berhasil Dihapus!');
        return redirect()->to('/users');
    }
}
