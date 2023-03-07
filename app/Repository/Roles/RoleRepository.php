<?php
namespace App\Repository\Roles;

use App\Core\Repository\Repository;
use App\Models\Role;

class RoleRepository extends Repository implements RoleRepositoryContract{

    public function model(): string
    {
        return Role::class;
    }
}
