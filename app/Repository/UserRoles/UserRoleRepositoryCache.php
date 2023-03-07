<?php
namespace App\Repository\UserRoles;

use App\Core\Repository\RepositoryCache;

class UserRoleRepositoryCache extends RepositoryCache implements UserRoleRepositoryContract{

    public function repository(): string
    {
        return UserRoleRepository::class;
    }
}
