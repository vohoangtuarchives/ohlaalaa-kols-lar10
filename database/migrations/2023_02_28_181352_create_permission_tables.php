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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string("title");
            $table->string("route");
            $table->string("group")->nullable();
            $table->string('slug')->nullable();
            $table->integer('index')->default(1);
            $table->enum('visibility', ['hide', 'show'])->default('show');

            //$table->enum('status', ['pending', 'completed'])->default('pending');


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
        Schema::dropIfExists('permissions');
    }
};
