<?php

namespace App\Http\Controllers\Index\Auth;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repository\Campaigns\CampaignRepositoryContract;
use App\Repository\Customers\CustomerRepositoryContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected $campaignRepository;
    protected $customerRepository;
    public function __construct(CustomerRepositoryContract $customerRepository, CampaignRepositoryContract $campaignRepository)
    {
        $this->customerRepository = $customerRepository;

        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $phone = $request->get("phone");

        $customer = $this->customerRepository->where("phone", '=', $phone)->first();

        $campaigns = $this->campaignRepository->all();
        return view('index.auth.register', [
            'campaigns' => $campaigns,
            'referrer' => $customer,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Customer::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ]);



        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $data = array_merge($input, [
            'referral_code' => md5($input['email']),
            'campaigns' => implode(',', $input['campaign'])
        ]);
        $user = Customer::create($data);

        foreach ($input['campaign'] as $campaignSlug){
            $campaign = Campaign::where("slug", '=', $campaignSlug)->first();

            $campaign->customers()->attach($user, [
                'referrer_code' => $input['referrer_code'],
                'referrer_id' =>$input['referrer_id'],
                'date_start' => $campaign->date_start,
                'remember_token' => Str::random(10),
                'amount' => $campaign->amount,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        event(new Registered($user));

        Auth::guard("customers")->login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
