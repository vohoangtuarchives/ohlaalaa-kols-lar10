<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("username", 80)->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("district")->nullable();
            $table->string("ward")->nullable();
            $table->string("ward_district_city")->nullable();
            $table->string("phone")->unique()->nullable();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("full_name")->nullable();
            $table->string("gender")->nullable();
            $table->string("date_of_birth")->nullable();
            $table->string("avatar")->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("username");
            $table->dropColumn("address");
            $table->dropColumn("ward");
            $table->dropColumn("city");
            $table->dropColumn("district");
            $table->dropColumn("phone");
            $table->dropColumn("ward_district_city");
            $table->dropColumn("first_name");
            $table->dropColumn("last_name");
            $table->dropColumn("full_name");
            $table->dropColumn("gender");
            $table->dropColumn("date_of_birth");
            $table->dropColumn("avatar");
        });
    }
};
