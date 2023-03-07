<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use App\Repository\Campaigns\CampaignRepositoryContract;
use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller{

    protected $customerRepository;

    protected $campaignRepository;

    public function __construct(CustomerRepositoryContract $customerRepository, CampaignRepositoryContract $campaignRepository)
    {
        $this->customerRepository = $customerRepository;

        $this->campaignRepository = $campaignRepository;
    }

    public function index(Request $request){
        $customer = Customer::findOrFail(Auth::guard("customers")->id());
        return view("index.profile", [
                'customer' => $customer
        ]);
    }

    public function update(Request $request){
        $customer = Customer::findOrFail(Auth::guard("customers")->id());
        foreach ($request->except(['_token', 'city_name', 'district_name', 'ward_name']) as $key => $value){
            $customer->{$key} = $value;
        }
        $customer->save();

        return redirect()->back()->with("success", 'Thay đổi thông tin thành công');
    }

    public function updatePassword(Request $request){
        return view("index.change-password");
    }

    public function storeUpdatePassword(Request $request){
        if($request->has('password') || $request->has('old_password') || $request->has('password_confirmation')) {
            $rules = [
                'old_password' => 'required|current_password:customers',
                'password' => 'required',
                'password_confirmation' => 'required',
            ];
            $messages = [
                'old_password.required' => 'Chưa nhập mật khẩu cũ.',
                'old_password.current_password' => 'Mật khẩu cũ không chính xác.'
            ];
        }else{
            $rules = [
                'name' => 'required',
            ];
            $messages = [
                'name.required' => 'Bạn chưa nhập tên.'
            ];
        }

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails())
        {

            return redirect()->back()->withErrors($validation);
        }

        $user = Auth::guard("customers")->user();
        if($request->get('password') != $request->get('password_confirmation')){
            Session::flash("error", "Nhập lại mật khẩu không khớp.");
            return redirect()->back();
        }

        $user->password = Hash::make($request->get('password'));

        $user->setRememberToken(Str::random(60));

        $user->save();
        Session::flash("success", "Cập nhật passowrd thành công.");
        return redirect()->back()->with("success", "Cập nhật passowrd thành công.");
    }


}