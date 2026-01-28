<?php

namespace App\Application\AdminUser;

use App\Domains\AdminUser\SearchAdminUserCriteria;
use App\Infrastructure\AdminUser\AdminUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

final class SearchAdminUserUseCase
{
    public function __construct(
        private AdminUserRepository $repository,
    ) {}

    public function handle(
        SearchAdminUserCriteria $criteria,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->repository->paginateByCriteria($criteria, $perPage);
    }
}