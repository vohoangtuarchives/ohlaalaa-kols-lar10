<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Roles\RoleRepositoryContract;

use App\Datatables\RoleTables;
use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    protected $roles;

    protected $roleRepository;


    public function __construct(RoleRepositoryContract $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function show(RoleTables $datatables){
            return $datatables->render("dashboard.pages.roles.index", [
                'entity' => "roles"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.roles.create");
    }

    public function store(Request $request){
        $title = $request->get('title');

        $role = Role::create([
            'code'          => Str::slug($title, '_'),
            'title'         => $title,
        ]);

        if($request->has('permissions')){
            $permissions = $request->get('permissions');
            $role->permissions()->sync($permissions);
        }

        Artisan::call("cache:clear");

        return redirect()->back();

    }
    public function edit($id){
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = \App\Models\Permission::all(['id', 'code', 'title', 'group']);
        if(request()->ajax()){
            return view("dashboard.pages.roles.modal.edit", [
                'role' => $role,
                'permissions' => $permissions->groupBy('group')
            ]);
        }
        abort(404);
    }

    public function update($id, Request $request){
        $role = Role::with('permissions')->findOrFail($id);
        $role->permissions()->sync($request->get('permissions'));
        Artisan::call("cache:clear");
        return redirect()->back();
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Role::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
