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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('download_kategoris');
            $table->string('title', 150);
            $table->string('token', 50)->unique();
            $table->string('file', 50)->unique();
            $table->boolean('publish')->default(true);
            $table->integer('hits')->default(0);
            $table->string('note', 255)->nullable();
            $table->integer('order')->default(1);
            $table->tinyInteger('extension')->nullable();
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
        Schema::dropIfExists('downloads');
    }
};
