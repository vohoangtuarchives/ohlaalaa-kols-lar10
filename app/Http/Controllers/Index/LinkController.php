<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use App\Repository\Campaigns\CampaignRepositoryContract;
use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LinkController extends Controller{

    protected $customerRepository;

    protected $campaignRepository;

    public function __construct(CustomerRepositoryContract $customerRepository, CampaignRepositoryContract $campaignRepository)
    {
        $this->customerRepository = $customerRepository;

        $this->campaignRepository = $campaignRepository;
    }

    public function links(Request $request){
        return view("index.links");
    }

}