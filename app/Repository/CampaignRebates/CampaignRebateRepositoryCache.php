<?php
namespace App\Repository\CampaignRebates;

use App\Core\Repository\RepositoryCache;

class CampaignRebateRepositoryCache extends RepositoryCache implements CampaignRebateRepositoryContract{

    public function repository(): string
    {
        return CampaignRebateRepository::class;
    }
}
