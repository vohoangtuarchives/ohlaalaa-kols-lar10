<?php
namespace App\Repository\UserRoles;

use App\Core\Repository\Repository;
use App\Models\UserRole;

class UserRoleRepository extends Repository implements UserRoleRepositoryContract{

    public function model(): string
    {
        return UserRole::class;
    }
}
