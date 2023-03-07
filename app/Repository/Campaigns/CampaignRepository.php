<?php
namespace App\Repository\Campaigns;

use App\Core\Repository\Repository;
use App\Models\Campaign;

class CampaignRepository extends Repository implements CampaignRepositoryContract{

    public function model(): string
    {
        return Campaign::class;
    }
}
