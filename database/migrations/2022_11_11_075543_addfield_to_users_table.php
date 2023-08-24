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
        Schema::table('users', function (Blueprint $table) {
            $table->string('token', 50)->unique()->after('id');
            $table->string('username', 100)->unique()->after('name');
            $table->tinyInteger('role')->default(0)->after('username');
            $table->integer('pegawai_id')->default(0)->after('token');
            $table->tinyInteger('publish')->default(1)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
