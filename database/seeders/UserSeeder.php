<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        $now = Carbon::now();
        $stt = 0;

        $gender = fake()->randomElement(['male', 'female']);

        DB::table('users')->insert([
            'id' => 1,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            "ward" => '',
            "city" => '',
            "district" => '',
            "ward_district_city" => '',
            "first_name" => fake()->firstName($gender),
            "last_name" => fake()->lastName(),
            "full_name" => fake()->name(),
            "avatar" => fake()->imageUrl(300,400),
            'username' => fake()->userName,
            'phone' => fake()->phoneNumber,
            'gender' => $gender,
            'date_of_birth' => fake()->date($format = 'd-m-Y', $max = 'now'),
        ]);

    }
}
