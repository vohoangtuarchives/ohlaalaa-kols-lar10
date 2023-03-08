<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CampaignHistory;
use App\Models\Customer;
use App\Models\CustomerCampaign;
use App\Models\User;
use App\Repository\Campaigns\CampaignRepositoryContract;
use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $currentDate;

    protected $startDate;

    protected $endDate;

    protected $customerRepository;

    protected $customerSelect = ['id', 'full_name', 'phone'];

    protected $campaignRepository;

    public function __construct(CustomerRepositoryContract $customerRepository,  CampaignRepositoryContract $campaignRepository)
    {
        $this->customerRepository = $customerRepository;

        $this->campaignRepository = $campaignRepository;
    }

    public function initDate(Request $request){
        $this->currentDate = Carbon::now();
        $this->startDate = $this->currentDate->clone();
        $this->startDate = $this->startDate->startOfDay();
        $this->endDate = null;

        if($request->has('start_date') && !empty($request->get('start_date'))){
            $this->startDate = Carbon::createFromFormat('d-m-Y', $request->get('start_date'));
            $this->startDate = $this->startDate->startOfDay();
        }
        if($request->has('end_date') && !empty($request->get('end_date'))){
            $this->endDate = Carbon::createFromFormat('d-m-Y', $request->get('end_date'));
        }
    }


    public function index(Request $request){

        $this->initDate($request);

        $user  = Auth::guard("customers")->user();

        $customers = $this->customersBetween($this->startDate, $this->endDate);

        $customerCampaigns = $this->registerCompletedCampaign($this->startDate, $this->endDate)
            ->groupBy("title")->get();

       foreach ($customerCampaigns as $campaign){
           $campaigns[strtolower($campaign->title)] = $campaign->count();
       }
        return view("dashboard.index", [
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate'   => $this->endDate ? $this->endDate->format('d-m-Y'): $this->startDate->format('d-m-Y'),
            'currentDate' => $this->currentDate->format('d-m-Y'),
            'customers' => $customers,
            'campaigns' => $campaigns
        ]);
    }

    protected function registerCompletedCampaign($start, $end){
        return CustomerCampaign::with(["campaign"])
            ->join("campaigns", "campaigns.id", '=', "customer_campaigns.campaign_id")
            ->select("campaigns.title as title")
            ->selectRaw("count(customer_campaigns.id) as count")
            ->where("customer_campaigns.status", '=', 'completed')
            ->whereBetween("customer_campaigns.created_at", [
                $start, $end
            ]);
    }



    protected function period($builder, $start, $end = null){
        if($end != null){
            return $builder->whereBetween("created_at", [
                $start, $end
            ]);
        }
        return  $builder->where("created_at", ">=", $start);
    }
    protected function customersBetween($start, $end = null){
        $customer =  $this->customerRepository->all();
        return $this->period($customer, $start, $end);
    }
}
