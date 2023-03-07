<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repository\Developments\DevelopmentContract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class ACLSeed extends Seeder
{
    protected $dev;
    public function __construct()
    {
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $view_setting_permission = Permission::find(1);
        $update_setting_permission = Permission::find(2);

        $super_admin_role = Role::query()->find(1);
        $admin = Role::query()->find(2);
        $mod = Role::query()->find(3);

        $super_admin_role->permissions()->attach($view_setting_permission);
        $super_admin_role->permissions()->attach($update_setting_permission);

        $user = User::find(1);

        $user->roles()->attach($super_admin_role);
    }
}
