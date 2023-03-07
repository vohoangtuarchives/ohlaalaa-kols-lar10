<?php
namespace App\Repository\CustomerTransactions;

use App\Core\Repository\Repository;
use App\Models\CustomerTransaction;

class CustomerTransactionRepository extends Repository implements CustomerTransactionRepositoryContract{

    public function model(): string
    {
        return CustomerTransaction::class;
    }
}
