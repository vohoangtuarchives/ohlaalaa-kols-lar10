<?php
namespace App\Repository\CustomerCampaigns;

use App\Core\Repository\RepositoryCache;

class CustomerCampaignRepositoryCache extends RepositoryCache implements CustomerCampaignRepositoryContract{

    public function repository(): string
    {
        return CustomerCampaignRepository::class;
    }
}
