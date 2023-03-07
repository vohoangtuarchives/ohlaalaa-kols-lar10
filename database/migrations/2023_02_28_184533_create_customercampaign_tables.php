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
        Schema::create('customer_campaigns', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'completed', 'canceled', 'refunded'])->default('pending');
            $table->double("amount")->default(0.0);

            $table->foreignId('campaign_id')->references('id')->on('campaigns');
            //$table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('customer_id')->references('id')->on('customers')->noActionOnDelete()->cascadeOnUpdate();
            $table->integer("referrer_id")->nullable();
            $table->string("referrer_code")->nullable();
            $table->string("date_start")->nullable();
            $table->string("date_end")->nullable();
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
        Schema::dropIfExists('customer_campaigns');
    }
};
