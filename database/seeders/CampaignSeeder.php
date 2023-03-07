<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CampaignSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('campaign_rebates')->truncate();
        DB::table('campaigns')->truncate();
        DB::table('customer_campaigns')->truncate();

        DB::table('campaigns')->insert([
            'id' => 1,
            'title'=> "Affiliate",
            'amount' => 2300000,
            'rebate_levels' => 3,
            'date_start' => \Carbon\Carbon::now(),
            'periods'   => 365,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('campaigns')->insert([
            'id' => 2,
            'title'=> "Shop",
            'amount' => 4600000,
            'rebate_levels' => 3,
            'date_start' => \Carbon\Carbon::now(),
            'periods'   => 3650,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('campaign_rebates')->insert([
            'id' => 1,
            'level_1' => 5,
            'level_2' => 2,
            'level_3' => 1,
            'campaign_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('campaign_rebates')->insert([
            'id' => 2,
            'level_1' => 3,
            'level_2' => 2,
            'level_3' => 1,
            'campaign_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}