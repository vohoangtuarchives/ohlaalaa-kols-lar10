<?php

namespace Database\Seeders;

use App\Repository\Cities\CityRepositoryContract;
use App\Repository\Districts\DistrictRepositoryContract;
use App\Repository\Wards\WardRepositoryContract;
use DB;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class CitiesDistrictsWardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cityRepository = app(CityRepositoryContract::class);
        $districtRepository = app(DistrictRepositoryContract::class);
        $wardRepository = app(WardRepositoryContract::class);

        $city = $cityRepository->find(1);
        if (empty ($city)) {


            $client = new Client();
            $body = $client->get('https://raw.githubusercontent.com/madnh/hanhchinhvn/master/dist/tinh_tp.json')->getBody();
            $cities = json_decode($body);

            // Import cities
            DB::table('cities')->truncate();
            DB::table('districts')->truncate();
            DB::table('wards')->truncate();

            $highOrderCities = ['ho-chi-minh', 'ha-noi', 'da-nang'];

            foreach ($cities as $city) {
                $newCity = $cityRepository->create([
                    'title' => $city->name,
                    'slug' => $city->slug,
                    'order' => in_array($city->slug, $highOrderCities) ? 1 : 0
                ]);

                $this->command->getOutput()->writeln("city <info>" . $city->name . "</info> is created successfully");

                // Get districts from city code
                $districtResult = $client->get("https://raw.githubusercontent.com/madnh/hanhchinhvn/master/dist/quan-huyen/{$city->code}.json")->getBody();
                $districts = json_decode($districtResult);

                foreach ($districts as $quan_huyen) {
                    $newDistrict = $districtRepository->create([
                        'title' => $quan_huyen->name_with_type,
                        'city_id' => $newCity->id
                    ]);
                    $this->command->getOutput()->writeln("quan_huyen <info>" . $quan_huyen->name_with_type . "</info> is created successfully");

                    // Get districts from city code
                    $wardResult = $client->get("https://raw.githubusercontent.com/madnh/hanhchinhvn/master/dist/xa-phuong/{$quan_huyen->code}.json")->getBody();
                    $wards = json_decode($wardResult);
                    $this->command->getOutput()->writeln("Load: https://raw.githubusercontent.com/madnh/hanhchinhvn/master/dist/xa-phuong/{$quan_huyen->code}.json");
                    try {
                        foreach ($wards as $xa_phuong) {
                            $wardRepository->create([
                                'title' => !empty($xa_phuong->name_with_type) ? $xa_phuong->name_with_type : 'Xã ' . $quan_huyen->name,
                                'path_with_type' => $xa_phuong->path_with_type,
                                'district_id' => $newDistrict->id
                            ]);
                            $this->command->getOutput()->writeln("xa_phuong <info>" . $xa_phuong->name_with_type . "</info> is created successfully");
                        }
                    } catch (\Exception $e) {
                        \Log::debug(json_encode($wards));
                    }
                }

            }
        }
    }
}