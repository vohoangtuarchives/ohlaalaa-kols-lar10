<?php
namespace App\Repository\Settings;

use App\Core\Repository\RepositoryCache;

class SettingRepositoryCache extends RepositoryCache implements SettingRepositoryContract{

    public function repository(): string
    {
        return SettingRepository::class;
    }
}
