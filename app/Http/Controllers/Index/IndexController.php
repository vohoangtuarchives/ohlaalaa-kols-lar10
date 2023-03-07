<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class IndexController extends Controller
{
    protected $currentDate;

    protected $startDate;

    protected $endDate;

    protected $customerRepository;

    protected $customerSelect = ['id', 'full_name', 'phone'];

    public function __construct(CustomerRepositoryContract $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function initDate(Request $request){
        $this->currentDate = Carbon::now();
        $this->startDate = $this->currentDate->clone();
        $this->startDate = $this->startDate->startOfDay();
        $this->endDate = null;

        if($request->has('start_date') && !empty($request->get('start_date'))){
            $this->startDate = Carbon::createFromFormat('d-m-Y', $request->get('start_date'));
            $this->startDate = $this->startDate->startOfDay();
        }
        if($request->has('end_date') && !empty($request->get('end_date'))){
            $this->endDate = Carbon::createFromFormat('d-m-Y', $request->get('end_date'));
        }
    }


    public function index(Request $request){

        $this->initDate($request);

        $user  = Auth::guard("customers")->user();

        $referral_level_1_2 = $this->customersBetween($this->startDate, $this->endDate)->where('referrer_id', '=', $user->id)->get($this->customerSelect);

        return view("index.welcome", [
            'referral_level_1_2' => $referral_level_1_2,
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate'   => $this->endDate ? $this->endDate->format('d-m-Y'): $this->startDate->format('d-m-Y'),
            'currentDate' => $this->currentDate->format('d-m-Y'),
            'transactions' => $this->period($user->transactions(), $this->startDate, $this->endDate)->get()
        ]);
    }

    public function settings(Request $request){

        $this->initDate($request);

        $user  = Auth::guard("customers")->user();

        $referral_level_1_2 = $this->customersBetween($this->startDate, $this->endDate)
            ->where('referrer_id', '=', $user->id)
            ->get($this->customerSelect);


        return view("index.welcome", [
            'referral_level_1_2' => $referral_level_1_2,
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate'   => $this->endDate ? $this->endDate->format('d-m-Y'): $this->startDate,
            'currentDate' => $this->currentDate->format('d-m-Y'),
            'transactions' => $user->transactions()
        ]);
    }


    protected function period($builder, $start, $end = null){
        if($end != null){
            return $builder->whereBetween("created_at", [
                $start, $end
            ]);
        }
        return  $builder->where("created_at", ">=", $start);
    }
    protected function customersBetween($start, $end = null){
        $customer =  $this->customerRepository->with("referrals");
        return $this->period($customer, $start, $end);
    }
}
