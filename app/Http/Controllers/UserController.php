<?php

namespace App\Http\Controllers;

use App\Models\TbUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = TbUser::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_user' => 'required|string|max:255',
                'email' => 'required|email|unique:tb_user,email',
                'username' => 'required|string|max:50|unique:tb_user,username',
                'password' => 'required',
                'jabatan' => 'required',
                'role' => 'required|string|in:superadmin,admin bidang,user',
            ],
            [
                'nama_user.required' => 'Nama user harus diisi.',
                'email.required' => 'Email harus diisi.',
                'jabatan.required' => 'Jabatan harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'username.unique' => 'Username sudah digunakan.',
                'password.required' => 'Password harus diisi.',
                'role.in' => 'Role harus berupa salah satu dari superadmin, admin bidang, atau user.',
            ]
        );


        $validatedData['password'] = Hash::make($validatedData['password']);

        TbUser::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TbUser $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TbUser $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TbUser $user)
    {
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_user,email,' . $user->id_user . ',id_user',
            'username' => 'required|string|max:255|unique:tb_user,username,' . $user->id_user . ',id_user',
            'jabatan' => 'required',
            'role' => 'required|string|in:superadmin,admin bidang,user',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TbUser $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }
}
