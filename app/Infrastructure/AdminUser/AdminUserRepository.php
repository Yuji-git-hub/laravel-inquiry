<?php

namespace App\Infrastructure\AdminUser;

use App\Domains\AdminUser\AdminUser;
use App\Domains\AdminUser\AdminUserId;
use App\Domains\AdminUser\SearchAdminUserCriteria;
use App\Infrastructure\AdminUser\Hydrator\AdminUserHydrator;
use App\Infrastructure\AdminUserRepositoryInterface;
use App\Models\User as AdminUserModel;
use Illuminate\Pagination\LengthAwarePaginator;

final class AdminUserRepository implements AdminUserRepositoryInterface
{
    public function __construct(
        private AdminUserHydrator $hydrator
    ) {}

    public function paginateByCriteria(
        SearchAdminUserCriteria $criteria,
        int $perPage = 10
    ): LengthAwarePaginator {
        $paginator = AdminUserModel::query()
            ->orderByDesc('created_at')
            ->paginate($perPage);

        $paginator->getCollection()->transform(
            fn (AdminUserModel $model) =>
                $this->hydrator->hydrate($model)
        );

        return $paginator;
    }

    public function findById(AdminUserId $id): ?AdminUser
    {
        $model = AdminUserModel::query()->find($id);

        return $model ? $this->hydrator->hydrate($model) : null;
    }

    public function persist(AdminUser $entity): void
    {
        $model = $entity->getId()->value() > 0
            ? AdminUserModel::query()->find($entity->getId()->value())
            : new AdminUserModel();

        $model->name = $entity->getName();
        $model->email = $entity->getEmail();
        $model->password = $entity->getPassword()->getHash();
        $model->remember_token = $entity->getRememberToken();
        $model->email_verified_at = $entity->getEmailVerifiedAt();

        $model->save();
    }
}