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
        Schema::create('cagar_budaya_galleries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('cagar_budaya_id');
            $table->string('title', 50)->nullable();
            $table->string('deskripsi', 100)->nullable();
            $table->string('file', 50)->unique();
            $table->tinyInteger('order');
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
        Schema::dropIfExists('cagar_budaya_galleries');
    }
};
