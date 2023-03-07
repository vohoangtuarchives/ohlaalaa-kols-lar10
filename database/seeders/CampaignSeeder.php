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
        DB::table('campaigns')->delete();
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
    }
}