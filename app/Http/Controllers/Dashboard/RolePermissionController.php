<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\RolePermissions\RolePermissionRepositoryContract;

use App\Datatables\RolePermissionTables;
use App\Models\RolePermission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
    protected $rolepermissions;

    protected $rolepermissionRepository;


    public function __construct(RolePermissionRepositoryContract $rolepermissionRepository)
    {
        $this->rolepermissionRepository = $rolepermissionRepository;
    }


    public function show(RolePermissionTables $datatables){
            return $datatables->render("dashboard.pages.rolepermissions.index", [
                'entity' => "rolepermissions"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.rolepermissions.create");
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

        $this->rolepermissionRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = RolePermission::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.rolepermissions.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.rolepermissions.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.rolepermissions.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = RolePermission::find($id);

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
                RolePermissions::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
