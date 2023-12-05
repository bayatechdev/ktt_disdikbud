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
        Schema::create('berita_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('gal_token', 50)->unique();
            $table->string('gal_title', 100)->nullable();
            $table->string('gal_image', 60)->unique();
            $table->foreignId('berita_id')->constrained('beritas');
            $table->tinyInteger('gal_status')->default(1);
            $table->integer('gal_order')->default(1);
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
        Schema::dropIfExists('berita_galleries');
    }
};
