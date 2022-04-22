<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function store(Request $request)
    {
        $validator = validator()->make($request->json()->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->messages()->first(), 400);
        }

        $email = strval($request->json('email'));
        $perms = strval($request->json('perms'));

        $p = ($perms) ? explode(',', $perms) : [];

        $action_log = new ActionLogService();
        if (Admin::where('email', '=', $email)->first()) {
            return response()->json(['error' => true, 'message' => '新增失敗，管理者已存在。']);
        }

        $admin = Admin::create([
            'name' => $name,
            'email' => $email,
            'permission' => json_encode($p)
        ]);

        return response()->json(['error' => false, 'message' => '新增成功。']);
    }

    public function update(Request $request, $id)
    {
        $validator = validator()->make($request->json()->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->messages()->first(), 400);
        }

        $name = strval($request->json('name'));
        $email = strval($request->json('email'));
        $perms = strval($request->json('perms'));

        $p = ($perms) ? explode(',', $perms) : [];

        if (!$admin = Admin::find($id)) {
            return response()->json(['error' => true, 'message' => '新增失敗，管理者不存在。']);
        }

        $admin->update([
            'email' => $email,
            'permission' => json_encode($p)
        ]);

        return response()->json(['error' => false, 'message' => '修改成功。']);
    }

    public function destroy(Request $request, $id)
    {
        if (!$admin = Admin::find($id)) {
            return response()->json(['error' => true, 'message' => '刪除失敗，管理者已不存在。']);
        }

        $admin->delete();

        return response()->json(['error' => false, 'message' => '刪除成功。']);
    }
}
