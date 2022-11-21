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
        Schema::create('jadwal_pertandingans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu', $precision = 5);
            $table->unsignedBigInteger('tim_home');
            $table->unsignedBigInteger('tim_away');
            $table->integer('total_skor_home')->default(0);
            $table->integer('total_skor_away')->default(0);
            $table->timestamps();
            //relation with tims table as tim home
            $table->foreign('tim_home')->references('id')->on('tims')->onDelete('cascade');
            
            //relation with tims table as tim home$table->foreign('tim_away')->references('id')->on('tim')->onDelete('cascade');
            $table->foreign('tim_away')->references('id')->on('tims')->onDelete('cascade');
            //add softdelete
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_pertandingans');
    }
};
