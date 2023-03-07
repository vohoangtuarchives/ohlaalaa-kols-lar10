<?php
namespace App\Repository\RolePermissions;

use App\Core\Repository\Repository;
use App\Models\RolePermission;

class RolePermissionRepository extends Repository implements RolePermissionRepositoryContract{

    public function model(): string
    {
        return RolePermission::class;
    }
}
