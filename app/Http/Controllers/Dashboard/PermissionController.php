<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Permissions\PermissionRepositoryContract;

use App\Datatables\PermissionTables;
use App\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    protected $permissions;

    protected $permissionRepository;


    public function __construct(PermissionRepositoryContract $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }


    public function show(PermissionTables $datatables){
            return $datatables->render("dashboard.pages.permissions.index", [
                'entity' => "permissions"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.permissions.create");
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

        $this->permissionRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Permission::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.permissions.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.permissions.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.permissions.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Permission::find($id);

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
                Permissions::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
