<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RoleController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        // Check if user can manage roles using Gate
        if (!Gate::allows('manage_roles')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();
        return view('manage-roles', compact('users'));
    }

    public function update(Request $request)
    {
        // Check if user can manage roles using Gate
        if (!Gate::allows('manage_roles')) {
            abort(403, 'Unauthorized action.');
        }

        foreach ($request->roles ?? [] as $userId => $roles) {
            $user = User::findOrFail($userId);
            $user->is_admin = isset($roles['admin']);
            $user->is_worker = isset($roles['worker']);
            $user->save();

            // Update permissions
            $permissions = $request->permissions[$userId] ?? [];
            foreach (['view_materials', 'edit_products', 'manage_units'] as $permission) {
                if (in_array($permission, $permissions)) {
                    Gate::allow($permission, $user);
                } else {
                    Gate::deny($permission, $user);
                }
            }
        }

        return redirect()->back()->with('success', 'Roles and permissions updated successfully.');
    }
}
