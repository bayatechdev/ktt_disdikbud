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
        Schema::create('bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('token', 50)->unique();
            $table->string('slug', 120)->unique();
            $table->string('nick', 25)->nullable();
            $table->string('note', 250)->nullable();
            $table->integer('order')->default(1);
            $table->tinyInteger('publish')->default(1);
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
        Schema::dropIfExists('bidangs');
    }
};
