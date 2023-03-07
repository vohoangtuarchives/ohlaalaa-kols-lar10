<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\CustomerCampaigns\CustomerCampaignRepositoryContract;

use App\Datatables\CustomerCampaignTables;
use App\Models\CustomerCampaign;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerCampaignController extends Controller
{
    protected $customercampaigns;

    protected $customercampaignRepository;


    public function __construct(CustomerCampaignRepositoryContract $customercampaignRepository)
    {
        $this->customercampaignRepository = $customercampaignRepository;
    }


    public function show(CustomerCampaignTables $datatables){
            return $datatables->render("dashboard.pages.customercampaigns.index", [
                'entity' => "customercampaigns"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.customercampaigns.create");
    }

    public function store(Request $request){
        $input = $request->all();

        $rules = array(
            'title'  => 'required|string'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        $this->customercampaignRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = CustomerCampaign::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customercampaigns.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.customercampaigns.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.customercampaigns.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = CustomerCampaign::find($id);

        $input = $request->except('_token');

        $rules = array(
                    'title'  => 'required|string'
                );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }
        $item->slug = null;
        $item->title = $input['title'];

        $item->save();

        return redirect()->back()->with('success', 'Item Updated');
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                CustomerCampaigns::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
