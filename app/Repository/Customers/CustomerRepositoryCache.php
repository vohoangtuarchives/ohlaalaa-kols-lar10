<?php
namespace App\Repository\Customers;

use App\Core\Repository\RepositoryCache;

class CustomerRepositoryCache extends RepositoryCache implements CustomerRepositoryContract{

    public function repository(): string
    {
        return CustomerRepository::class;
    }
}
