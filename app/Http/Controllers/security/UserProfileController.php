<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\security\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{

    public function index(){
        $logedUser = Auth::user();

        $user = User::findOrFail($logedUser->id);

        return view('security.user-profile.index', compact('user'));
    }

    public function updateProfile(Request $request){
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
}
