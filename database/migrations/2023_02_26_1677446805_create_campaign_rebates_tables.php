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
        Schema::create('campaign_rebates', function (Blueprint $table) {
            $table->id();
            $table->double("level_1")->default(0.0);
            $table->double("level_2")->default(0.0);
            $table->double("level_3")->default(0.0);
            $table->double("level_4")->default(0.0);
            $table->double("level_5")->default(0.0);
            $table->double("level_6")->default(0.0);
            $table->double("level_7")->default(0.0);
            $table->double("level_8")->default(0.0);
            $table->double("level_9")->default(0.0);
            $table->double("level_10")->default(0.0);
            $table->string('date_start')->nullable();
            $table->foreignId('campaign_id')->references('id')->on('campaigns')->cascadeOnDelete();

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
        Schema::dropIfExists('campaign_rebates');
    }
};
