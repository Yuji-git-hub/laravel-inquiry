<?php

namespace App\Infrastructure\AdminUser\Hydrator;

use App\Domains\AdminUser\AdminUser;
use App\Domains\AdminUser\AdminUserId;
use App\Domains\AdminUser\EmailAddress;
use App\Domains\AdminUser\Password;
use Carbon\CarbonImmutable;
use App\Models\User as AdminUserModel;

final class AdminUserHydrator
{
    public function hydrate(AdminUserModel $model): AdminUser
    {
        return new AdminUser(
            new AdminUserId($model->id),
            $model->name,
            new EmailAddress($model->email),
            $model->email_verified_at
                ? CarbonImmutable::instance($model->email_verified_at)
                : null,
            Password::fromHash($model->password),
            $model->remember_token,
            CarbonImmutable::instance($model->created_at),
            CarbonImmutable::instance($model->updated_at),
        );
    }

    public function toModel(AdminUser $entity): AdminUserModel
    {
        $model = new AdminUserModel();

        $model->id = $entity->getId()->getValue();
        $model->name = $entity->getName();
        $model->email = $entity->getEmail();
        $model->password = $entity->getPassword()->getHash();
        $model->email_verified_at = $entity->getEmailVerifiedAt();
        $model->remember_token = $entity->getRememberToken();

        return $model;
    }
}