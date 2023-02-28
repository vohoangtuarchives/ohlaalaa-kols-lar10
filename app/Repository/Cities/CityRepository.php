<?php
namespace App\Repository\Cities;

use App\Core\Repository\Repository;
use App\Models\City;

class CityRepository extends Repository implements CityRepositoryContract{

    public function model(): string
    {
        return City::class;
    }
}
