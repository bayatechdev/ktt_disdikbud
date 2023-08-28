<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 15);
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans');
            $table->string('title', 100)->nullable();
            $table->string('slug', 120)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('shp', 255)->nullable();
            $table->string('maps_id', 25)->nullable();
            $table->integer('urut')->nullable();
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
        Schema::dropIfExists('desas');
    }
}
