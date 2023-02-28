<?php
namespace App\Repository\Districts;

use App\Core\Repository\RepositoryCache;

class DistrictRepositoryCache extends RepositoryCache implements DistrictRepositoryContract{

    public function repository(): string
    {
        return DistrictRepository::class;
    }
}
