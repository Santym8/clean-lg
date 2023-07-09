<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\security\Role;
use App\Models\security\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $users = User::all();

        // Get only active asignation roles
        foreach ($users as $user) {
            $active_roles = array();
            foreach ($user->roles as $role) {
                if ($role->status == 1) {
                    array_push($active_roles, $role);
                }
            }
            $user->roles = $active_roles;
        }



        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }


        $available_roles = Role::all()->where('status', 1);
        return view('users.create', ['available_roles' => $available_roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $userValidated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
            'identification_type' => ['required', 'string', 'min:3', 'max:255'],
            'identification' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10', 'unique:users'],
            'selected_roles' => ['array'],
        ]);

        $user = new User($userValidated);
        $user->save();

        // Todo - Validate if role is active

        if (isset($userValidated['selected_roles'])) {
            foreach ($userValidated['selected_roles'] as $role_id) {
                $user->roles()->attach($role_id);
            }
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
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }


        $user = User::findOrFail($id);
        $user->password = '';

        // Get only asignation and roles that are activated
        $active_roles = array();
        foreach ($user->roles as $role) {
            if ($role->pivot->status == 1 && $role->status == 1) {
                array_push($active_roles, $role);
            }
        }
        $user->roles = $active_roles;

        $id_active_roles = array();
        foreach ($user->roles as $role) {
            array_push($id_active_roles, $role->id);
        }

        // Get only available roles
        $available_roles = Role::all()->where('status', 1)->whereNotIn('id', $id_active_roles);

        return view('users.update', ['user' => $user, 'available_roles' => $available_roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleNames = array("ADMINSTRADOR_DE_SISTEMA");
        if (!Gate::allows('has-rol', [$roleNames])) {
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $userValidated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($id),],
            'identification_type' => ['required', 'string', 'min:3', 'max:255'],
            'identification' => ['required', 'string', 'min:3', 'max:255', Rule::unique('users')->ignore($id)],
            'phone_number' => ['required', 'string', 'min:10', 'max:10', Rule::unique('users')->ignore($id)],
            'status' => ['required'],
            'selected_roles' => ['array'],
        ]);

        if(!isset($userValidated['selected_roles'])){
            $userValidated['selected_roles'] = array();
        }

        $user = User::findOrFail($id);
        $user->fill($userValidated);

        // Todo - Validate if role is active

        // Delete roles that are not selected
        foreach ($user->roles as $role) {
            if (!in_array($role->pivot['role_id'], $userValidated['selected_roles'])) {
                $role->pivot['status'] = false;
                $role->pivot->save();
            }
        }

        foreach ($userValidated['selected_roles'] as $role_id) {
            // Check if the user already has the role
            if ($user->roles->pluck('id')->contains($role_id)) {
                continue;
            }

            // Check if the role is new
            if (!$user->roles->pluck('id')->contains($role_id)) {
                $user->roles()->attach($role_id);
            }
        }

        $user->save();




        return redirect()->route('users.index')->with('success', 'Usuario actualizado con exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
