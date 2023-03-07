<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Cache::flush();
//        $this->call(SuperAdminSeeder::class);
        Model::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('customers')->truncate();
        DB::table('campaigns')->truncate();
        DB::table('customer_campaigns')->truncate();
        DB::table('customer_transactions')->truncate();
        DB::table('campaign_histories')->truncate();
        DB::table('campaign_rebates')->truncate();


        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ACLSeed::class);
        $this->call(CampaignSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CitiesDistrictsWardsSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
