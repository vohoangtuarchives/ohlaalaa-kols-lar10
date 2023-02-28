<?php
namespace App\Repository\Cities;

use App\Core\Repository\RepositoryCache;

class CityRepositoryCache extends RepositoryCache implements CityRepositoryContract{

    public function repository(): string
    {
        return CityRepository::class;
    }
}
