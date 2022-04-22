<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
        ]);

        Role::create([
            // 首字母大寫
            'name' => Str::ucfirst(request('name')),
            // 空格改-
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        return back();
    }

    public function delete(Role $role)
    {
        $role->delete();
        session()->flash('role-delete', 'Deleted Role ' . $role->name);
        return back();
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Role $role)
    {
        request()->validate([
            'name' => ['required'],
        ]);

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($role->isDirty('name')) {
            $role->save();
            session()->flash('role-update', 'Updated Role ' . $role->name);

            return view('admin.roles.index', [
                'roles' => Role::all(),
            ]);
        }else{
            session()->flash('role-noupdate', 'Nothing has been updated');
            return back();
        }
    }

    public function attach(Role $role)
    {
        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach(Role $role)
    {
        $role->permissions()->detach(request('permission'));

        return back();
    }
}
