<?php
namespace App\Repository\CustomerWithdraws;

use App\Core\Repository\RepositoryCache;

class CustomerWithdrawRepositoryCache extends RepositoryCache implements CustomerWithdrawRepositoryContract{

    public function repository(): string
    {
        return CustomerWithdrawRepository::class;
    }
}
