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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('berita_kategoris');
            $table->foreignId('user_id')->constrained('users');
            $table->string('title', 150);
            $table->string('slug', 170)->unique();
            $table->string('image', 50)->unique()->nullable();
            $table->boolean('headline')->default(true);
            $table->dateTime('tanggal');
            $table->longText('content')->nullable();
            $table->boolean('publish')->default(true);
            $table->string('tags', 150)->nullable();
            $table->integer('hits')->nullable();
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
        Schema::dropIfExists('beritas');
    }
};
