<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\CustomerInfos\CustomerInfoRepositoryContract;

use App\Datatables\CustomerInfoTables;
use App\Models\CustomerInfo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerInfoController extends Controller
{
    protected $customerinfos;

    protected $customerinfoRepository;


    public function __construct(CustomerInfoRepositoryContract $customerinfoRepository)
    {
        $this->customerinfoRepository = $customerinfoRepository;
    }


    public function show(CustomerInfoTables $datatables){
            return $datatables->render("dashboard.pages.customerinfos.index", [
                'entity' => "customerinfos"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.customerinfos.create");
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

        $this->customerinfoRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = CustomerInfo::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customerinfos.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.customerinfos.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.customerinfos.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = CustomerInfo::find($id);

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
                CustomerInfos::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
