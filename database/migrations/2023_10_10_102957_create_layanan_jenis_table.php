<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_jenis', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('token', 50)->unique();
            $table->string('slug', 100);
            $table->string('image', 100)->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('hits')->nullable();
            $table->boolean('publish')->default(true);
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('layanan_jenis');
    }
}
