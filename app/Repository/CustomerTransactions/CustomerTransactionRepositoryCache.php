<?php
namespace App\Repository\CustomerTransactions;

use App\Core\Repository\RepositoryCache;

class CustomerTransactionRepositoryCache extends RepositoryCache implements CustomerTransactionRepositoryContract{

    public function repository(): string
    {
        return CustomerTransactionRepository::class;
    }
}
