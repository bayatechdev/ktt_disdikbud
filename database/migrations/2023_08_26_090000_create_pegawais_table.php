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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('token', 50)->unique();
            $table->foreignId('bidang_id')->nullable()->constrained('bidangs');
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatans');
            $table->foreignId('golongan_id')->nullable()->constrained('golongans');
            $table->foreignId('eselon_id')->nullable()->constrained('eselons');
            $table->string('nip', 30)->nullable();
            $table->string('nama', 50);
            $table->tinyInteger('jkel')->default(1);
            $table->string('lahir_tempat', 50)->nullable();
            $table->date('lahir_tanggal')->nullable();
            $table->text('alamat', 500)->nullable();
            $table->string('gambar', 50)->nullable();
            $table->string('notelp', 30)->nullable();
            $table->string('agama', 30)->nullable();
            $table->tinyInteger('publish')->default(1);
            $table->integer('urutan')->nullable();
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
        Schema::dropIfExists('pegawais');
    }
};
