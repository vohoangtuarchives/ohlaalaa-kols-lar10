<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("username", 80)->nullable();
            $table->string('password');
            $table->string("city")->nullable();
            $table->string("district")->nullable();
            $table->string("ward")->nullable();
            $table->string('full_name')->nullable();
            $table->string("ward_district_city")->nullable();
            $table->string("address")->nullable();
            $table->string("phone")->unique()->nullable();
            $table->string("gender")->nullable();
            $table->string("date_of_birth")->nullable();
            $table->string("avatar")->nullable();

            $table->enum('status', ['pending', 'active', 'banned'])->default('pending');

            $table->double("balance")->default(0.0);

            $table->foreignId('referrer_id')->nullable();

            $table->string("referral_code")->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
