<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */

class CampaignFactory extends Factory{

    public function definition()
    {
        return [
            'title'=> fake()->name(),
            'amount' => fake()->randomNumber(1,30) * 100000,
            'rebate_levels' => fake()->randomNumber(2,4),
            'date_start' => \Carbon\Carbon::now(),
            'periods'   => fake()->randomNumber(1,12) * 30,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ];
    }
}