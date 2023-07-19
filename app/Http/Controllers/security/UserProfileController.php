<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\security\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{

    public function index()
    {
        $logedUser = Auth::user();

        $user = User::findOrFail($logedUser->id);

        return view('security.user-profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $logedUser = Auth::user();

        $user = User::findOrFail($logedUser->id);

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($user->id),],
            'phone_number' => ['required', 'string', 'min:10', 'max:10', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->phone_number = $request['phone_number'];
        $user->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_user_profile'], 'user_id: ' . $user->id);
        return redirect()->route('dashboard')->with('success', 'Perfil actualizado con exito.');
    }


    public function editPassword()
    {
        return view('security.user-profile.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $logedUser = Auth::user();
        $user = User::findOrFail($logedUser->id);

        if (!password_verify($request['current_password'], $user->password)) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_user_password'], 'user_id: ' . $user->id);
            return redirect()->route('user_profile.editPassword')->with('error', 'La contraseña actual no es correcta.');
        }

        $request->validate([
            'new_password' => [
                'required', 'string', 'min:8', 'max:64',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&_-]/', // must contain a special character,
            ],
        ], [
            'new_password.required' => 'Contraseña requerida.',
            'new_password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'new_password.max' => 'La contraseña debe tener máximo 64 caracteres.',
            'new_password.regex' => 'La contraseña debe tener al menos una letra mayúscula, una minúscula, un número y un caracter especial @$!%*#?&_-.',
        ]);

        if ($request['new_password'] != $request['password_confirmation']) {
            return redirect()->route('user_profile.editPassword')->with('error', 'Las contraseñas no coinciden.');
        }

        $user->password = $request['new_password'];
        $user->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_user_password'], 'user_id: ' . $user->id);
        return redirect()->route('dashboard')->with('success', 'Contraseña actualizada con exito.');
    }
}
