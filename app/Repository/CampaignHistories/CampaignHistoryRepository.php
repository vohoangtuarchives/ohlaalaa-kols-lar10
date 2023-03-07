<?php
namespace App\Repository\CampaignHistories;

use App\Core\Repository\Repository;
use App\Models\CampaignHistory;

class CampaignHistoryRepository extends Repository implements CampaignHistoryRepositoryContract{

    public function model(): string
    {
        return CampaignHistory::class;
    }
}
