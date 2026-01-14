<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Models\User;

class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    public function store(StoreAdminUserRequest $request)
    {
        $user = User::create($request->validated());

        return redirect()->route('admin.users.index')
                         ->with('success', 'ユーザー登録が完了しました。');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateAdminUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->validated());

        return redirect()->route('admin.users.index')
                         ->with('success', 'ユーザーを更新しました。');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'ユーザーを削除しました。');
    }
}
