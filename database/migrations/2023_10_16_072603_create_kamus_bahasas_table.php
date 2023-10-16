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
        Schema::create('kamus_bahasas', function (Blueprint $table) {
            $table->id();
            $table->string('title', '100')->unique();           // Indonesia - Tidung
            $table->string('alias', '50')->unique();            // IND-TDG
            $table->string('description', '255')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->boolean('active', true);
            $table->softDeletes();
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
        Schema::dropIfExists('kamus_bahasas');
    }
};
