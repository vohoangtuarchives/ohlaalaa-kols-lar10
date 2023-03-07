<?php
namespace App\Repository\Permissions;

use App\Core\Repository\Repository;
use App\Models\Permission;

class PermissionRepository extends Repository implements PermissionRepositoryContract{

    public function model(): string
    {
        return Permission::class;
    }
}
