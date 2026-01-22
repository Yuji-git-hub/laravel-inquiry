<?php

namespace App\Application\AdminUser\Search;

use App\Domains\AdminUser\SearchAdminUserCriteria;
use App\Infrastructure\AdminUserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class SearchAdminUserUseCase
{
    public function __construct(
        private AdminUserRepositoryInterface $repository,
    ) {}

    public function handle(
        SearchAdminUserCriteria $criteria,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->repository->paginateByCriteria($criteria, $perPage);
    }
}