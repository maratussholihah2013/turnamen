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
        Schema::create('hasil_pertandingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemain_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->string('waktu_gol');
            $table->timestamps();
            //relation with tims table
            $table->foreign('pemain_id')->references('id')->on('pemains')->onDelete('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_pertandingans')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_pertandingans');
    }
};
