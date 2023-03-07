<?php
namespace App\Repository\Campaigns;

use App\Core\Repository\RepositoryCache;

class CampaignRepositoryCache extends RepositoryCache implements CampaignRepositoryContract{

    public function repository(): string
    {
        return CampaignRepository::class;
    }
}
