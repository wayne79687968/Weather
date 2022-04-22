<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permission::all(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        return back();
    }

    public function delete(Permission $permission)
    {
        $permission->delete();
        session()->flash('permission-delete', 'Deleted permission ' . $permission->name);
        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name' => ['required'],
        ]);

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($permission->isDirty('name')) {
            $permission->save();
            session()->flash('permission-update', 'Updated permission ' . $permission->name);

            return view('admin.permissions.index', [
                'permissions' => permission::all(),
            ]);
        }else{
            session()->flash('permission-noupdate', 'Nothing has been updated');
            return back();
        }
    }
}
