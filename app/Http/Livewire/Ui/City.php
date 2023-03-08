<?php

namespace App\Http\Livewire\Ui;

use App\Models\Customer;
use App\Repository\Cities\CityRepositoryContract;
use App\Repository\Districts\DistrictRepositoryContract;
use App\Repository\Wards\WardRepositoryContract;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class City extends Component
{
    protected $cityRepository;

    protected $districtRepository;

    protected $wardRepository;

    protected $selected;

    public $city;

    public $cities;

    public $district;

    public $districts;

    public $ward;

    public $wards;

    public $customer;

    public $address;

    public function __construct()
    {
        $this->cityRepository = app(CityRepositoryContract::class);
        $this->districtRepository = app(DistrictRepositoryContract::class);
        $this->wardRepository = app(WardRepositoryContract::class);

    }

    public function mount(Customer $customer = null){
        $this->customer = $customer;
        $this->cities = $this->cityRepository->all();
        if(!is_null($customer)){
            $this->city = $customer->city;
            $this->district = $customer->district;
            $this->ward = $customer->ward;
            $this->districts = $this->districtRepository->where("city_id", "=", $this->city)->get();
            $this->wards = $this->wardRepository->where("district_id", "=", $this->ward)->get();
            $this->address = $customer->address;
        }
    }

    public function render()
    {
        return view('livewire.ui.city');
    }

    public function city($city){
        $this->districts = null;
        $this->districts = $this->districtRepository->where("city_id", "=", $city)->get();
        $this->city = $city;
        $this->wards = null;
    }

    public function district($district){
        $this->wards = null;
        $this->wards = $this->wardRepository->where("district_id", "=", $district)->get();
        $this->district = $district;
    }

    public function ward($ward){
        $this->ward = $ward;
    }

}
