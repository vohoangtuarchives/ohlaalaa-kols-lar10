<?php
namespace App\Repository\UserPermissions;

use App\Core\Repository\Repository;
use App\Models\UserPermission;

class UserPermissionRepository extends Repository implements UserPermissionRepositoryContract{

    public function model(): string
    {
        return UserPermission::class;
    }
}
