<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\CreateRoleRequest;
use App\Http\Requests\Admin\Roles\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    
    public function index(){
        Gate::authorize('viewAny', Role::class);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(CreateRoleRequest $request){
        Gate::authorize('create', Role::class);
        
        Role::create($request->validated());
        return back()->with('success', 'Role created successfully');
    }
    
    public function update(UpdateRoleRequest $request, Role $role){
        Gate::authorize('update', $role);
        
        $role->update(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);
        return back()->with('success', 'Role updated successfully');
    }
    
    public function destroy(Role $role){
        Gate::authorize('delete', $role);
        
        $role->delete();
        return back()->with('success', 'Role deleted successfully');
    }
}
