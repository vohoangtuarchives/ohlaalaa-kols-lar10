<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Cache::flush();
//        $this->call(SuperAdminSeeder::class);

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ACLSeed::class);
        $this->call(CampaignSeeder::class);
        $this->call(CustomerSeeder::class);

//        $this->call(CitiesDistrictsWardsSeeder::class);
    }
}
