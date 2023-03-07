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

        $now = Carbon::now();
        $stt = 0;

        $campaigns = Campaign::with("customers")->get();

        $gender = fake()->randomElement(['male', 'female']);
        $rootCode = md5('hoangtu@ohlaalaa.com');

        Customer::insert([
            'id' => 1,
            'name' => fake()->name(),
            'email' => 'hoangtu@ohlaalaa.com',
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
            'gender' => 'Nam',
            'date_of_birth' => '04-09-1989',
            'referrer_id' => null,
            'referral_code' => $rootCode,
            'created_at' => \Illuminate\Support\Carbon::now(),
            'updated_at' => \Illuminate\Support\Carbon::now(),
        ]);

        for ($i = 2; $i <= 20; $i++){

            $email = 'customer_'.$i.'@gmail.com';

             Customer::insert([
                 'id' => $i,
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
                'referrer_id' => 1,
                'referral_code' => md5($email),
                 'created_at' => \Illuminate\Support\Carbon::now(),
                 'updated_at' => \Illuminate\Support\Carbon::now(),
            ]);
            $customer = Customer::find($i);
            foreach($campaigns as $campaign){
                $campaign->customers()->attach($customer,[
                        'referrer_code' => $rootCode,
                        'referrer_id' => 1,
                        'date_start' => $campaign->date_start,
                        'amount' => $campaign->amount,
                        'created_at' => \Illuminate\Support\Carbon::now(),
                        'updated_at' => Carbon::now()
                ]);
            }
        }


        for ($i = 21; $i <= 50; $i++){

            $email = 'customer_'.$i.'@gmail.com';
            $secondCode = md5($email);
            Customer::insert([
                'id' => $i,
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
                'referrer_id' => mt_rand(1,20),
                'referral_code' => md5($email),
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now(),
            ]);
            $customer = Customer::find($i);
            foreach($campaigns as $campaign){
                $campaign->customers()->attach($customer);
            }
        }


    }
}
