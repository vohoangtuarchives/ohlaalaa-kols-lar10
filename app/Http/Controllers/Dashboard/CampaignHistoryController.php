<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\CampaignHistories\CampaignHistoryRepositoryContract;

use App\Datatables\CampaignHistoryTables;
use App\Models\CampaignHistory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignHistoryController extends Controller
{
    protected $campaignhistories;

    protected $campaignhistoryRepository;


    public function __construct(CampaignHistoryRepositoryContract $campaignhistoryRepository)
    {
        $this->campaignhistoryRepository = $campaignhistoryRepository;
    }


    public function show(CampaignHistoryTables $datatables){
            return $datatables->render("dashboard.pages.campaignhistories.index", [
                'entity' => "campaignhistories"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.campaignhistories.create");
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

        $this->campaignhistoryRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = CampaignHistory::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.campaignhistories.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.campaignhistories.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.campaignhistories.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = CampaignHistory::find($id);

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
                CampaignHistories::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
