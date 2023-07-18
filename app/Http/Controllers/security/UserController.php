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

    private $pathViews = 'security.system-administrator.users';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['USER/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_user'], '');
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


        $this->addAudit(Auth::user(), $this->typeAudit['access_index_user'], '');
        return view($this->pathViews . '.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['USER/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_user'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }


        $available_roles = Role::all()->where('status', 1);
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_user'], '');
        return view($this->pathViews . '.create', ['available_roles' => $available_roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['USER/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_user'], '');
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

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_user'], 'user_id: ' . $user->id);
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
        if (!Gate::allows('action-allowed-to-user', ['USER/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_user'], 'user_id: ' . $id);
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

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_user'], 'user_id: ' . $id);
        return view($this->pathViews . '.update', ['user' => $user, 'available_roles' => $available_roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['USER/UPDATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_update_user'], 'user_id: ' . $id);
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

        if (!isset($userValidated['selected_roles'])) {
            $userValidated['selected_roles'] = array();
        }

        $user = User::findOrFail($id);
        $user->fill($userValidated);

        // Todo - Validate if role is active

        // // Delete roles that are not selected
        // foreach ($user->roles as $role) {
        //     if (!in_array($role->pivot['role_id'], $userValidated['selected_roles'])) {
        //         $role->pivot['status'] = false;
        //         $role->pivot->save();
        //     }
        // }

        // foreach ($userValidated['selected_roles'] as $role_id) {
        //     // Check if the user already has the role
        //     if ($user->roles->pluck('id')->contains($role_id)) {
        //         continue;
        //     }

        //     // Check if the role is new
        //     if (!$user->roles->pluck('id')->contains($role_id)) {
        //         $user->roles()->attach($role_id);
        //     }
        // }

        $user->roles()->sync($userValidated['selected_roles']);

        $user->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_user'], 'user_id: ' . $id);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado con exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    public function resetPassword(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['USER/RESET_PASSWORD'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_reset_password_user'], 'user_id: ' . $id);
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $user = User::findOrFail($id);

        if($user == null){
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        }

        error_log($request[$user->name]);
        $user->password = $user->identification;
        $user->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_reset_password_user'], 'user_id: ' . $id);
        return redirect()->route('users.index')->with('success', 'Contraseña actualizada con exitosamente.');
    }
}
