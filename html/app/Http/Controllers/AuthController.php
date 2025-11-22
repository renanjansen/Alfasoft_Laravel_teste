<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/people');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function createStaticUser()
    {
        // Verificar se o usuário já existe
        if (!User::where('email', 'admin@alfasoft.pt')->exists()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@alfasoft.pt',
                'password' => Hash::make('password123'),
            ]);
            return "Usuário criado: admin@alfasoft.pt / password123";
        }
        return "Usuário já existe";
    }
}
