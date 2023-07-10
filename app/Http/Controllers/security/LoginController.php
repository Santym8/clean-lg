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
            $this->addAudit(null, $this->typeAudit['failed_login'], 'Intento de inicio de sesión fallido del usuario: ' . $request->input('identification'));
            return redirect()->route('login')->withErrors([
                'identification' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }

        if (Auth::user()->status == false) {
            $this->addAudit(Auth::user(), $this->typeAudit['user_desabled'], '');
            Auth::logout();
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
        $this->addAudit(Auth::user(), $this->typeAudit['successful_logout'], '');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
