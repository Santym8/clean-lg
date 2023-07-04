<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $available_roles = Role::all();
        return view('users.create', ['available_roles' => $available_roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userValidated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
            'identification_type' => ['required', 'string', 'min:3', 'max:255'],
            'identification' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10', 'unique:users'],
            'selected_roles' => ['required', 'array'],
        ]);

        $user = new User($userValidated);
        $user->save();

        foreach ($userValidated['selected_roles'] as $role_id) {
            $user->roles()->attach($role_id);
        }



        return redirect()->route('users.index')->with('success', 'Usuario creado con exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $user->password = '';
        return view('users.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userValidated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($id),],
            'identification_type' => ['required', 'string', 'min:3', 'max:255'],
            'identification' => ['required', 'string', 'min:3', 'max:255', Rule::unique('users')->ignore($id)],
            'phone_number' => ['required', 'string', 'min:10', 'max:10', Rule::unique('users')->ignore($id)],
            'status' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->fill($userValidated)->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
