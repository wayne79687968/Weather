<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('admin.users.profile', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['min:8', 'max:255', 'confirmed'],
        ]);
        $user->update($inputs);
        Session::flash('user_update_message', 'User profile was updated');

        return back();
    }

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    public function delete(User $user, Request $request)
    {
        $user->delete();
        $request->session()->flash('user_delete_message', 'User "' . $user->username . '" was deleted');

        return back();
    }

    public function attach(User $user)
    {
        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user)
    {
        $user->roles()->detach(request('role'));

        return back();
    }
}
