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
        Schema::create('sekilas_infos', function (Blueprint $table) {
            $table->id();
            $table->string('content', 255)->nullable();
            $table->string('token', 50)->unique();
            $table->string('image', 50)->unique()->nullable();
            $table->integer('order')->default(1);
            $table->boolean('publish')->default(true);
            $table->string('link', 255)->nullable();
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
        Schema::dropIfExists('sekilas_infos');
    }
};
