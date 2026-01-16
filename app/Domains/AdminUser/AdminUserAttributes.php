<?php

namespace App\Domains\AdminUser;

class AdminUserAttributes
{
    public function __construct(
        public string $name,
        public EmailAddress $email,
        public Password $password,
    )
    {}
}