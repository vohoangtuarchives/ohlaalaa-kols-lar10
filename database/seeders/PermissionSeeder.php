<?php

namespace Database\Seeders;

use App\Repository\Developments\DevelopmentContract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        DB::table('role_permissions')->truncate();
        DB::table('user_roles')->truncate();

        Artisan::call("permission:reload");
    }
}
