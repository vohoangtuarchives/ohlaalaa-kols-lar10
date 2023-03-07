<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Customers\CustomerRepositoryContract;

use App\Datatables\CustomerTables;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    protected $customers;

    protected $customerRepository;


    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }


    public function show(CustomerTables $datatables){
            return $datatables->render("dashboard.pages.customers.index", [
                'entity' => "customers"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.customers.create");
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

        $this->customerRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Customer::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.customers.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.customers.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.customers.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Customer::find($id);

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
                Customers::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
