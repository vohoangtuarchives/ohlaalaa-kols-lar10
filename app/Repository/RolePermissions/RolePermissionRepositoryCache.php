<?php
namespace App\Repository\RolePermissions;

use App\Core\Repository\RepositoryCache;

class RolePermissionRepositoryCache extends RepositoryCache implements RolePermissionRepositoryContract{

    public function repository(): string
    {
        return RolePermissionRepository::class;
    }
}
