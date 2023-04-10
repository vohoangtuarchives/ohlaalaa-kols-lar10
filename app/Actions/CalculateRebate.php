<?php

namespace App\Actions;

use App\Models\Campaign;
use App\Models\Customer;
use App\Models\CustomerCampaign;
use App\Models\CustomerTransaction;
use App\Repository\Campaigns\CampaignRepositoryContract;
use App\Repository\CustomerCampaigns\CustomerCampaignRepositoryContract;
use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Support\Facades\App;

class CalculateRebate{

    protected $customer_id;

    protected $campaign_id;

    protected $customerCampaignRepository;

    protected $customerRepository;

    protected $campaignRepository;

    protected $customerCampaign;

    public function __construct($customer_id, $campaign_id)
    {
        $this->customer_id = $customer_id;

        $this->campaign_id = $campaign_id;

        $this->customerCampaign = CustomerCampaign::query()
            ->where('customer_id','=', $customer_id)
            ->where('campaign_id','=', $campaign_id)->first();
    }

    public function calc(){

        $campaign = Campaign::find($this->campaign_id);

        $customer = Customer::with("referrer")->where('id', '=', $this->customer_id)->first();

        $customer_id_level_1 = $customer->referrer_id ?? 0;


        if($customer_id_level_1 > 0){
            $rebate_level_1 = $campaign->currenRateLevel_1() * $campaign->amount / 100;

            Customer::where('id', '=', $customer_id_level_1)->update([
                'balance' => $customer->referrer->balance + $rebate_level_1,
            ]);

            CustomerTransaction::create([
                'content' => 'Thưởng level 1 ['.$campaign->title.']',
                'amount' => $rebate_level_1,
                'old_balance' => $customer->referrer->balance,
                'balance' => $customer->referrer->balance + $rebate_level_1,
                'customer_id' => $customer_id_level_1
            ]);

            $customer_id_level_2 = $customer->referrer->referrer_id ?? 0;

            $customer_level_2 = Customer::with("referrer")->find($customer_id_level_2);


        }

        if(isset($customer_id_level_2) && $customer_id_level_2 > 0){
            $rebate_level_2 = $campaign->currenRateLevel_2() * $campaign->amount / 100;


            Customer::where('id', '=', $customer_id_level_2)->update([
                'balance' => $customer_level_2->balance + $rebate_level_2,
            ]);

            CustomerTransaction::create([
                'content' => 'Thưởng level 2 ['.$campaign->title.']',
                'amount' => $rebate_level_2,
                'old_balance' => $customer_level_2->balance,
                'balance' => $customer_level_2->balance + $rebate_level_2,
                'customer_id' => $customer_id_level_2
            ]);

            $customer_id_level_3 = $customer_level_2->referrer_id;
        }

        if(isset($customer_id_level_3) && $customer_id_level_3 > 0){

            $rebate_level_3 = $campaign->currenRateLevel_3() * $campaign->amount / 100;

            Customer::where('id', '=', $customer_id_level_3)->update([
                'balance' => $customer_level_2->referrer->balance + $rebate_level_3,
            ]);

            CustomerTransaction::create([
                'content' => 'Thưởng level 3 ['.$campaign->title.']',
                'amount' => $rebate_level_3,
                'old_balance' => $customer_level_2->referrer->balance,
                'balance' => $customer_level_2->referrer->balance + $rebate_level_3,
                'customer_id' => $customer_id_level_3
            ]);

        }

    }

}