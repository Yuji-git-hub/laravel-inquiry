<?php

namespace App\Application\AdminUser;

use App\Domains\AdminUser\AdminUser;
use App\Domains\AdminUser\AdminUserId;
use App\Infrastructure\AdminUser\AdminUserRepository;

final class ShowAdminUserUseCase
{
    public function __construct(
        private AdminUserRepository $repository
    ) {}

    public function handle(int $id): AdminUser
    {
        $adminUserId = new AdminUserId($id);

        $adminUser = $this->repository->findById($adminUserId);

        if($adminUser === null) {
            throw new \DomainException('管理ユーザーが見つかりません');
        }

        return $adminUser;
    }
}