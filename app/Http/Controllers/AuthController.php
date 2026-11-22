<?php

namespace App\Http\Controllers;

use App\Models\TbUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function loginForm($type)
    {
        if ($type == 'superadmin') {
            $type = 'Superadmin';
        } else if ($type == 'admin_bidang') {
            $type = 'Admin Bidang';
        } else if ($type == 'user') {
            $type = 'User';
        }
        return view('login', compact('type'));
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'type');

        $pengguna = TbUser::where('role', $credentials['type'])
            ->where('email', $credentials['email'])
            ->orWhere('username', $credentials['email'])
            ->first();

        if ($pengguna && Hash::check($credentials['password'], $pengguna->password)) {
            Auth::login($pengguna);
            session()->put('userdata', [
                'id_user' => $pengguna->id_user,
                'nama_user' => $pengguna->nama_user,
                'email' => $pengguna->email,
                'role' => $pengguna->role,
            ]);
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Berhasil logout!');
    }
}
