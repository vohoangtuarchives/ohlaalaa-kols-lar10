<?php
namespace App\Repository\Users;

use App\Core\Repository\Repository;
use App\Models\User;

class UserRepository extends Repository implements UserRepositoryContract{

    public function model(): string
    {
        return User::class;
    }
}
