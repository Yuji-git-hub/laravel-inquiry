<?php

namespace App\Infrastructure\AdminUser;

use App\Domains\AdminUser\AdminUser;
use App\Domains\AdminUser\SearchAdminUserCriteria;
use App\Infrastructure\AdminUser\Hydrator\AdminUserHydrator;
use App\Models\User as AdminUserModel;

class AdminUserRepository
{
    private AdminUserHydrator $hydrator;

    public function __construct(AdminUserHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function paginateByCriteria(
        SearchAdminUserCriteria $criteria,
        int $perPage = 15
    ) {
        $query = AdminUserModel::query();

        if($criteria->name !== null) {
            $query->where('name', 'like', '%' . $criteria->name . '$');
        }

        if ($criteria->email !== null) {
            $query->where('email', $criteria->email->value);
        }

        if ($criteria->createdFrom !== null) {
            $query->where('created_at', '>=', $criteria->createdFrom);
        }

        if ($criteria->createdTo !== null) {
            $query->where('created_at', '<=', $criteria->createdTo);
        }

        return $query->paginate($perPage);
    }

    public function persist(AdminUser $entity): void
    {
        $model = $this->hydrator->toModel($entity);
        $model->save();
    }
}