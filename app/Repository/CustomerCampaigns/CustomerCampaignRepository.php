<?php
namespace App\Repository\CustomerCampaigns;

use App\Core\Repository\Repository;
use App\Models\CustomerCampaign;

class CustomerCampaignRepository extends Repository implements CustomerCampaignRepositoryContract{

    public function model(): string
    {
        return CustomerCampaign::class;
    }
}
