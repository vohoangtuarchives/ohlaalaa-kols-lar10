<?php
namespace App\Repository\Users;

use App\Core\Repository\RepositoryCache;

class UserRepositoryCache extends RepositoryCache implements UserRepositoryContract{

    public function repository(): string
    {
        return UserRepository::class;
    }
}
