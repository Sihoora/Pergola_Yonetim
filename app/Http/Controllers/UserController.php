<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.include.index', compact('users', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        $role = Role::find($request->role_id);
        if ($role) {
            $user->syncRoles([$role->name]);
            return redirect()->back()->with('success', 'Rol başarıyla atandı.');
        }
        return redirect()->back()->with('error', 'Geçersiz rol.');
    }
}
