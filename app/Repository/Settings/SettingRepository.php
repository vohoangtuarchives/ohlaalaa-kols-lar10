<?php
namespace App\Repository\Settings;

use App\Core\Repository\Repository;
use App\Models\Setting;

class SettingRepository extends Repository implements SettingRepositoryContract{

    public function model(): string
    {
        return Setting::class;
    }
}
