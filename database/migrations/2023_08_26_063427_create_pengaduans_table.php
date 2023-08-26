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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('email', 250)->nullable();
            $table->string('subject', 250)->nullable();
            $table->longText('message');
            $table->boolean('read')->default(false);
            $table->string('nohp', 17)->nullable();
            $table->string('file', 50)->nullable();
            $table->string('ktp', 50)->nullable();
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
        Schema::dropIfExists('pengaduans');
    }
};
