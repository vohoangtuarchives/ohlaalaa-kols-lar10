<?php
namespace App\Repository\CustomerInfos;

use App\Core\Repository\Repository;
use App\Models\CustomerInfo;

class CustomerInfoRepository extends Repository implements CustomerInfoRepositoryContract{

    public function model(): string
    {
        return CustomerInfo::class;
    }
}
