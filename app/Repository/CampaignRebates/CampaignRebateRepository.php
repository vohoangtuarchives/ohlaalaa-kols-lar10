<?php
namespace App\Repository\CampaignRebates;

use App\Core\Repository\Repository;
use App\Models\CampaignRebate;

class CampaignRebateRepository extends Repository implements CampaignRebateRepositoryContract{

    public function model(): string
    {
        return CampaignRebate::class;
    }
}
