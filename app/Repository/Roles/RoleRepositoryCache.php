<?php
namespace App\Repository\Roles;

use App\Core\Repository\RepositoryCache;

class RoleRepositoryCache extends RepositoryCache implements RoleRepositoryContract{

    public function repository(): string
    {
        return RoleRepository::class;
    }
}
