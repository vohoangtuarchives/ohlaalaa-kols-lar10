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
        Schema::create('customer_withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('amount');

            $table->enum('status', ['pending', 'completed', 'canceled', 'rejected'])->default('pending');

            $table->string('reviewed_by');

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
        Schema::dropIfExists('customer_withdraws');
    }
};
