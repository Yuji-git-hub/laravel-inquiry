<?php

namespace App\Domains\AdminUser;

final readonly class AdminUserId
{
    public function __construct(private int $value)
    {
        if($value <= 0) {
            throw new \InvalidArgumentException('IDは正の整数です。');
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function equals(AdminUserID $other): bool
    {
        return $this->value === $other->value;
    }
}