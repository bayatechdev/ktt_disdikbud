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
        Schema::create('eselons', function (Blueprint $table) {
            $table->id();
            $table->string('token', 50);
            $table->string('title', 20);
            $table->string('slug', 25)->nullable();
            $table->string('description', 250)->nullable();
            $table->integer('urutan')->nullable();
            $table->tinyInteger('publish')->default(1);
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
        Schema::dropIfExists('eselons');
    }
};
