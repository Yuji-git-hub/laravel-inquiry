<?php

namespace App\Domains\AdminUser;

use Carbon\CarbonImmutable;

final class AdminUserFactory
{
    public function make(
        string $name,
        EmailAddress $email,
        Password $password,
        CarbonImmutable $now,
    ): AdminUser {
        return new AdminUser(
            new AdminUserId(0),
            $name,
            $email,
            null,
            $password,
            null,
            $now,
            $now,
        );
    }
}