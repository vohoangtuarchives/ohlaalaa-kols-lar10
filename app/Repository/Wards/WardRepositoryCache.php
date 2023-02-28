<?php
namespace App\Repository\Wards;

use App\Core\Repository\RepositoryCache;

class WardRepositoryCache extends RepositoryCache implements WardRepositoryContract{

    public function repository(): string
    {
        return WardRepository::class;
    }
}
