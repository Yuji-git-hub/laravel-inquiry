<?php

namespace App\Http\Controllers\AdminUser;

use App\Application\AdminUser\UpdateAdminUserUseCase;
use App\Domains\AdminUser\AdminUserId;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminUserRequest;

final class AdminUserUpdateController extends Controller
{
    public function __construct(
        private UpdateAdminUserUseCase $useCase
    ) {}

    public function __invoke(
        UpdateAdminUserRequest $request,
        string $id
    ) {
        $this->useCase->handle(
            new AdminUserId($id),
            $request->name(),
            $request->email(),
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', '管理ユーザーを更新しました。');
    }
}