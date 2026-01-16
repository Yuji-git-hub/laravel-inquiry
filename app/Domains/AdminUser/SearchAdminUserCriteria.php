<?php

namespace App\Domains\AdminUser;

use Carbon\CarbonImmutable;

final class SearchAdminUserCriteria
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?EmailAddress $email,
        public readonly ?CarbonImmutable $createdFrom,
        public readonly ?CarbonImmutable $createdTo,
    ) {}
}