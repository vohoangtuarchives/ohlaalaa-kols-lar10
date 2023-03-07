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
        Campaign::factory()->count(5)->create();
    }
}