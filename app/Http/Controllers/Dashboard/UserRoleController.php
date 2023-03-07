<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\UserRoles\UserRoleRepositoryContract;

use App\Datatables\UserRoleTables;
use App\Models\UserRole;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    protected $userroles;

    protected $userroleRepository;


    public function __construct(UserRoleRepositoryContract $userroleRepository)
    {
        $this->userroleRepository = $userroleRepository;
    }


    public function show(UserRoleTables $datatables){
            return $datatables->render("dashboard.pages.userroles.index", [
                'entity' => "userroles"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.userroles.create");
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

        $this->userroleRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = UserRole::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.userroles.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.userroles.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.userroles.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = UserRole::find($id);

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
                UserRoles::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}
