<?php
namespace App\Repository\CustomerWithdraws;

use App\Core\Repository\Repository;
use App\Models\CustomerWithdraw;

class CustomerWithdrawRepository extends Repository implements CustomerWithdrawRepositoryContract{

    public function model(): string
    {
        return CustomerWithdraw::class;
    }
}
