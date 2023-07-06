<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'identification' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors([
                'identification' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }

        if (Auth::user()->status == false) {
            return redirect()->route('login')->withErrors([
                'identification' => 'El usuario se encuentra inactivo.',
            ]);
        }

        $request->session()->regenerate();


        $this->addAudit(Auth::user(), $this->typeAudit['successful_login'], '');
        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
