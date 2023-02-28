<?php
namespace App\Repository\Districts;

use App\Core\Repository\Repository;
use App\Models\District;

class DistrictRepository extends Repository implements DistrictRepositoryContract{

    public function model(): string
    {
        return District::class;
    }
}
