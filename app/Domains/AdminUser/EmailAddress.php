<?php

namespace App\Domains\AdminUser;

class EmailAddress
{
    public function __construct(public string $value)
    {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("メールアドレス形式が不正です");
        }
    }
}