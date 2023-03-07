<?php
namespace App\Repository\CustomerInfos;

use App\Core\Repository\RepositoryCache;

class CustomerInfoRepositoryCache extends RepositoryCache implements CustomerInfoRepositoryContract{

    public function repository(): string
    {
        return CustomerInfoRepository::class;
    }
}
