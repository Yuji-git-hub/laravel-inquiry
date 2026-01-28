<?php

namespace App\Application\AdminUser;

use App\Domains\AdminUser\AdminUserId;
use App\Domains\AdminUser\EmailAddress;
use App\Infrastructure\AdminUser\AdminUserRepository;
use Illuminate\Support\Facades\DB;

final class UpdateAdminUserUseCase
{
    public function __construct(
        private AdminUserRepository $adminUserRepository,
    ) {}

    public function handle(
        AdminUserId $id,
        string $name,
        EmailAddress $email,
    ): void {
        DB::transaction(function () use ($id, $name, $email) {
            $adminUser = $this->adminUserRepository->findById($id);

            $adminUser->changeName($name);
            $adminUser->changeEmail($email);

            $this->adminUserRepository->persist($adminUser);
        });
    }
}