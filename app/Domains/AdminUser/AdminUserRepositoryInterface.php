<?php

namespace App\Infrastructure;

use App\Domains\AdminUser\AdminUser;
use App\Domains\AdminUser\AdminUserId;
use App\Domains\AdminUser\EmailAddress;
use App\Domains\AdminUser\SearchAdminUserCriteria;

interface AdminUserRepositoryInterface
{
    public function save(AdminUser $adminUser): void;

    public function findById(AdminUserId $id): ?AdminUser;

    public function findByEmail(EmailAddress $email): ?AdminUser;

    /**
     * @return AdminUser[]
     */
    public function search(SearchAdminUserCriteria $criteria): array;
}