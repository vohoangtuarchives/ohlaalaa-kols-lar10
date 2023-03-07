<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\CampaignRebates\CampaignRebateRepositoryContract;

use App\Datatables\CampaignRebateTables;
use App\Models\CampaignRebate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignRebateController extends Controller
{
    protected $campaignrebates;

    protected $campaignrebateRepository;


    public function __construct(CampaignRebateRepositoryContract $campaignrebateRepository)
    {
        $this->campaignrebateRepository = $campaignrebateRepository;
    }


    public function show(CampaignRebateTables $datatables){
            return $datatables->render("dashboard.pages.campaignrebates.index", [
                'entity' => "campaignrebates"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.campaignrebates.create");
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

        $this->campaignrebateRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = CampaignRebate::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.campaignrebates.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.campaignrebates.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.campaignrebates.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = CampaignRebate::find($id);

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
                CampaignRebates::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
