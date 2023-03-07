<?php

namespace Database\Seeders;

use App\Repository\Developments\DevelopmentContract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RoleSeeder extends Seeder
{
    protected $dev;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $now = Carbon::now();
        $stt = 0;

        DB::table('roles')->insert([
            'id'            => 1,
            'code'          => 'super_admin',
            'title'         => 'Super Admin',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('roles')->insert([
            'id'            => 2,
            'code'          => 'administrator',
            'title'         => 'Administrator',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('roles')->insert([
            'id'            => 3,
            'code'          => 'moderator',
            'title'         => 'Moderator',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

        DB::table('roles')->insert([
            'id'            => 4,
            'code'          => 'member',
            'title'         => 'Member',
            'created_at'    => $now,
            'updated_at'    => $now,
        ]);

    }
}
