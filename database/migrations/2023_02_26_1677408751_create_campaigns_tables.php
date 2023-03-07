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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->double("amount");
            $table->integer("rebate_levels")->default(3);

            $table->string('date_start')->nullable();

            $table->integer('periods')->default(0);

            //$table->enum('status', ['pending', 'processing', 'completed'])->default('pending');


            //$table->foreignId('playlist_id')->references('id')->on('playlists');
            //$table->foreignId('category_id')->references('id')->on('categories');
            //$table->foreignId('customer_id')->references('id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('campaigns');
    }
};
