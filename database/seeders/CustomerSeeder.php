<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\CustomerCampaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        $now = Carbon::now();
        $stt = 0;

        $campaigns = Campaign::with("customers")->get();

        $gender = fake()->randomElement(['male', 'female']);

        for ($i = 1; $i <= 10; $i++){

            $email = 'customer_'.$i.'@gmail.com';

             Customer::insert([
                'name' => fake()->name(),
                'email' => $email,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                "ward" => '',
                "city" => '',
                "district" => '',
                "ward_district_city" => '',
                "avatar" => fake()->imageUrl(300,400),
                'username' => fake()->userName,
                'phone' => fake()->phoneNumber,
                'full_name' => fake()->name(),
                'gender' => $gender,
                'date_of_birth' => fake()->date($format = 'd-m-Y', $max = 'now'),
                'referrer_id' => fake()->randomNumber(1,20),
                'referral_code' => md5($email),
                'created_at' => fake()->time("Y-m-d H:i:s"),
                'updated_at' => fake()->time("Y-m-d H:i:s"),
            ]);
            $customer = Customer::find($i);
            foreach($campaigns as $campaign){
                $campaign->customers()->attach($customer);
            }
        }


    }
}
