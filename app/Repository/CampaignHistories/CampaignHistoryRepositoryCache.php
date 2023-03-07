<?php
namespace App\Repository\CampaignHistories;

use App\Core\Repository\RepositoryCache;

class CampaignHistoryRepositoryCache extends RepositoryCache implements CampaignHistoryRepositoryContract{

    public function repository(): string
    {
        return CampaignHistoryRepository::class;
    }
}
