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
        Schema::create('cagar_budayas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('desa_id');
            $table->string('nama_objek', 100);
            $table->string('slug', 100);
            $table->string('nama_tempat', 100)->nullable();
            $table->string('alamat', 100)->nullable();
            
            $table->text('deskripsi')->nullable();
            $table->text('riwayat_kepemilikan')->nullable();
            $table->text('latar_sejarah')->nullable();

            $table->string('koordinat_lat', 50)->nullable();
            $table->string('koordinat_long', 50)->nullable();

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
        Schema::dropIfExists('cagar_budayas');
    }
};
