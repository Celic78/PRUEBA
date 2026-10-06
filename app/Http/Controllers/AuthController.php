<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->esNutriologo() 
                ? redirect()->route('nutriologo.dashboard') 
                : redirect()->route('paciente.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->esNutriologo()) {
                return redirect()->intended(route('nutriologo.dashboard'));
            }

            return redirect()->intended(route('paciente.dashboard'));
        }

        return back()->withErrors([
            'name' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}