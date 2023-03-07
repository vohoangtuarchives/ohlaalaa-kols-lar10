<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\CustomerWithdraws\CustomerWithdrawRepositoryContract;

use App\Datatables\CustomerWithdrawTables;
use App\Models\CustomerWithdraw;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerWithdrawController extends Controller
{
    protected $customerwithdraws;

    protected $customerwithdrawRepository;


    public function __construct(CustomerWithdrawRepositoryContract $customerwithdrawRepository)
    {
        $this->customerwithdrawRepository = $customerwithdrawRepository;
    }


    public function show(CustomerWithdrawTables $datatables){
            return $datatables->render("dashboard.pages.customerwithdraws.index", [
                'entity' => "customerwithdraws"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.customerwithdraws.create");
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

        $this->customerwithdrawRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = CustomerWithdraw::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customerwithdraws.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.customerwithdraws.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.customerwithdraws.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = CustomerWithdraw::find($id);

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
                CustomerWithdraws::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
