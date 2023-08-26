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
        Schema::create('gallery_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('albums_id')->nullable()->constrained('gallery_albums');
            $table->string('title', 150);
            $table->string('token', 50)->unique();
            $table->string('slug', 170)->unique();
            $table->string('image', 50)->unique();
            $table->boolean('publish')->default(true);
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('gallery_fotos');
    }
};
