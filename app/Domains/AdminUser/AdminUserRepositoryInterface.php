<?php

namespace App\Infrastructure;

use App\Domains\AdminUser\AdminUser;
use App\Domains\AdminUser\AdminUserId;
use App\Domains\AdminUser\SearchAdminUserCriteria;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdminUserRepositoryInterface
{
    public function findById(AdminUserId $id): ?AdminUser;

    public function paginateByCriteria(
        SearchAdminUserCriteria $criteria,
        int $perPage = 10
    ): LengthAwarePaginator;

    public function persist(AdminUser $entity): void;
}