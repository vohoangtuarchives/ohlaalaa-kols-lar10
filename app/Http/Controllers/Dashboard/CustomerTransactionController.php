<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\CustomerTransactions\CustomerTransactionRepositoryContract;

use App\Datatables\CustomerTransactionTables;
use App\Models\CustomerTransaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerTransactionController extends Controller
{
    protected $customertransactions;

    protected $customertransactionRepository;


    public function __construct(CustomerTransactionRepositoryContract $customertransactionRepository)
    {
        $this->customertransactionRepository = $customertransactionRepository;
    }


    public function show(CustomerTransactionTables $datatables){
            return $datatables->render("dashboard.pages.customertransactions.index", [
                'entity' => "customertransactions"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.customertransactions.create");
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

        $this->customertransactionRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = CustomerTransaction::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customertransactions.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.customertransactions.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.customertransactions.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = CustomerTransaction::find($id);

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
                CustomerTransactions::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
