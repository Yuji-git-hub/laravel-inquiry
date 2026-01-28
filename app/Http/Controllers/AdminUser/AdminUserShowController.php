<?php

namespace App\Http\Controllers\AdminUser;

use App\Application\AdminUser\ShowAdminUserUseCase;
use App\Http\Controllers\Controller;

final class AdminUserShowController extends Controller
{
    public function __construct(
        private ShowAdminUserUseCase $useCase
    ) {}

    public function __invoke(int $adminUserId)
    {
        $adminUser = $this->useCase->handle($adminUserId);

        return view('admin.users.show', [
            'adminUser' => $adminUser
        ]);
    }
}