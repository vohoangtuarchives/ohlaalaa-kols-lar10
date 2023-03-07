<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Repository\Users\UserRepositoryContract;

use App\Datatables\UserTables;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $users;

    protected $userRepository;


    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(UserTables $datatables){
        return $datatables->render("dashboard.pages.users.index");
    }

    public function edit($id){
        $user  = $this->userRepository->with('roles')->findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.users.partials.edit", [
                'user' => $user,
            ]);
        }
        abort(404);

    }

    public function update($id, Request $request){

        $user = $this->userRepository->findOrFail($id);

        $input = $request->except(['_token', '_method']);

        foreach ($input as $key => $value){

            if($key == 'password' && is_null($value)) continue;
            else if($key == 'role'){
                $user->roles()->sync($value);
            }else{
                $user->{$key} = $key == 'password' ? Hash::make($value) : $value;
            }
        }

        $user->save();

        return redirect()->back()->with('alert_success', 'Cập nhật thành công');

    }

    public function store(Request $request){

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user =  User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $user->roles()->attach(Role::find($request->get('role')));

        return redirect()->back()->with('alert_success', 'Tạo tài khoản mới thành công');
    }

    public function delete(){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                User::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }


    public function updateStorePassword(Request $request){
        $rules = [
            'old_password' => 'required|current_password:web',
            'password' => 'required',
            'password_confirmation' => 'required',
        ];
        $messages = [
            'old_password.required' => 'Chưa nhập mật khẩu cũ.',
            'old_password.current_password' => 'Mật khẩu cũ không chính xác.'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {

            return redirect()->back()->withErrors($validation);
        }

        $user = Auth::user();
        if($request->get('password') != $request->get('password_confirmation')){
            Session::flash("error", "Nhập lại mật khảu không khớp.");
            return redirect()->back();
        }

        $user->password = Hash::make($request->get('password'));

        $user->setRememberToken(Str::random(60));

        $user->save();

        return redirect()->back()->with("success", "Cập nhật passowrd thành công.");
    }

    public function updatePassword(){
        return view("dashboard.pages.admin.index");
    }

}
