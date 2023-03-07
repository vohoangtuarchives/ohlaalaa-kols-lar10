<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\UserPermissions\UserPermissionRepositoryContract;

use App\Datatables\UserPermissionTables;
use App\Models\UserPermission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserPermissionController extends Controller
{
    protected $userpermissions;

    protected $userpermissionRepository;


    public function __construct(UserPermissionRepositoryContract $userpermissionRepository)
    {
        $this->userpermissionRepository = $userpermissionRepository;
    }


    public function show(UserPermissionTables $datatables){
            return $datatables->render("dashboard.pages.userpermissions.index", [
                'entity' => "userpermissions"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.userpermissions.create");
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

        $this->userpermissionRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = UserPermission::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.userpermissions.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.userpermissions.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.userpermissions.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = UserPermission::find($id);

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
                UserPermissions::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
