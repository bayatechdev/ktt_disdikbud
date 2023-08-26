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
        Schema::create('slide_utamas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('token', 50)->unique();
            $table->string('image', 50)->unique();
            $table->integer('order')->default(1);
            $table->boolean('publish')->default(true);
            $table->string('note', 250)->nullable();
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
        Schema::dropIfExists('slide_utamas');
    }
};
