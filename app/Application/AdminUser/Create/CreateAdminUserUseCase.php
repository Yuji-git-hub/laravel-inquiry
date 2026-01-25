<?php

namespace App\Application\AdminUser\Create;

use App\Domains\AdminUser\EmailAddress;
use App\Domains\AdminUser\Password;
use App\Infrastructure\AdminUser\AdminUserRepository;
use App\Models\User;

final class CreateAdminUserUseCase
{
    public function __construct(
        private AdminUserRepository $repository
    ) {}

    public function handle(
        string $name,
        string $email,
        string $password
    ): void {
        $adminUser = User::create(
            name: new $name,
            email: new EmailAddress($email),
            password: Password::fromPlainText($password),
        );

        $this->repository->persist($adminUser);
    }
}