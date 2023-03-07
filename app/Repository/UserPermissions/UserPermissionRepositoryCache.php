<?php
namespace App\Repository\UserPermissions;

use App\Core\Repository\RepositoryCache;

class UserPermissionRepositoryCache extends RepositoryCache implements UserPermissionRepositoryContract{

    public function repository(): string
    {
        return UserPermissionRepository::class;
    }
}
