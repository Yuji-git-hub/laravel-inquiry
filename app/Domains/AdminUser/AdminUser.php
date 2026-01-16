<?php

namespace App\Domains\AdminUser;

use Carbon\CarbonImmutable;

class AdminUser
{
    public function __construct(
        private AdminUserId $id,
        private string $name,
        private EmailAddress $email,
        private ?CarbonImmutable $emailVerifiedAt,
        private Password $password,
        private ?string $rememberToken,
        private CarbonImmutable $createdAt,
        private CarbonImmutable $updatedAt,
    ) {}

    public function getId(): AdminUserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email->value;
    }

    public function getEmailVerifiedAt(): ?CarbonImmutable
    {
        return $this->emailVerifiedAt;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function updateAttributes(
        AdminUserAttributes $attributes,
        CarbonImmutable $now
    ): void {
        $this->name = $attributes->name;
        $this->email = $attributes->email;
        $this->password = $attributes->password;
        $this->updatedAt = $now;
    }
}