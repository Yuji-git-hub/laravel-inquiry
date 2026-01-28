<?php

namespace App\Http\Controllers\AdminUser;

use App\Application\AdminUser\CreateAdminUserUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUserRequest;

final class AdminUserStoreController extends Controller
{
    public function __construct(
        private CreateAdminUserUseCase $useCase
    )
    {}

    public function __invoke(StoreAdminUserRequest $request)
    {
        $this->useCase->handle(
            name: $request->name(),
            email: $request->email(),
            password: $request->password(),
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', '管理ユーザーを登録しました。');
    }
}
