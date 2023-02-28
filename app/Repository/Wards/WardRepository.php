<?php
namespace App\Repository\Wards;

use App\Core\Repository\Repository;
use App\Models\Ward;

class WardRepository extends Repository implements WardRepositoryContract{

    public function model(): string
    {
        return Ward::class;
    }
}
