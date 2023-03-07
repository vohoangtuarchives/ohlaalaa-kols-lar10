<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\CalculateRebate;
use App\Datatables\CampaignRegisterTables;
use App\Http\Controllers\Controller;

use App\Http\Request\CampaignRebateRequest;
use App\Repository\Campaigns\CampaignRepositoryContract;

use App\Datatables\CampaignTables;
use App\Models\Campaign;

use App\Repository\CustomerCampaigns\CustomerCampaignRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    protected $campaigns;

    protected $campaignRepository;

    protected $customerCampaignRepository;


    public function __construct(CampaignRepositoryContract $campaignRepository, CustomerCampaignRepositoryContract $customerCampaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
        $this->customerCampaignRepository = $customerCampaignRepository;
    }


    public function show(CampaignTables $datatables){
        return $datatables->render("dashboard.pages.campaigns.index", [
            'entity' => "campaigns"
        ]);
    }

    public function create(Request $request){
        return view("dashboard.pages.campaigns.create");
    }

    public function store(CampaignRebateRequest $request){

        $validated = $request->validated();

        $campaign = $this->campaignRepository->create($validated);

        if(is_array($validated['level']) && count($validated['level']) > 0){

            $levels = [];

            foreach ($validated['level'] as $i => $value){
                $levels['level_'. $i] = $value[0];
            }

            $campaign->rebates()->updateOrCreate([
                'campaign_id' => $campaign->id,
                'date_start'    => date("d-m-Y", time())
            ],$levels);

        }

        return redirect()->back()->with("success", "Successful");
    }
    public function edit($id){
        $item = $this->campaignRepository->findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.campaigns.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.campaigns.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.campaigns.edit", [
            'item' => $item
        ]);
    }

    public function showRebate($id, Request $request){
        $campaign = $this->campaignRepository->with('rebates')->findOrFail($id);
        $rebate = $campaign->rebates;
        return response()->json($rebate);

    }

    public function update($id, CampaignRebateRequest $request){
        $validated = $request->validated();

        $item = $this->campaignRepository->with("rebates")->findOrFail($id);

        $item->update($validated);

        if(is_array($validated['level']) && count($validated['level']) > 0){

            $levels = [];

            foreach ($validated['level'] as $i => $value){
                $levels['level_'. $i] = $value;
            }

            $item->rebates()->updateOrCreate([
                'campaign_id' => $id,
                'date_start'    => date("d-m-Y", time())
            ],$levels);

        }

        Cache::flush();

        return redirect()->back()->with("success", "Update Successful");
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                $this->campaignRepository->destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }

    public function showCampaignRegister(CampaignRegisterTables $datatables){
        return $datatables->render("dashboard.pages.campaigns.register.index", [
            'entity' => "campaigns"
        ]);
    }

    public function verifyPaymentCampaign(Request $request){
        if(request()->has('id') && request()->has('customer')){
            $id = request()->get('id');
            $customer  = request()->get('customer');
            try {
                $verify = $this->customerCampaignRepository
                    ->where('customer_id','=', $customer)
                    ->where('campaign_id','=', $id)
                    ->update(['status' => 'completed']);

                if($verify){
                    $calcRebates = new CalculateRebate($customer, $id);
                    $calcRebates->calc();
                }
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
