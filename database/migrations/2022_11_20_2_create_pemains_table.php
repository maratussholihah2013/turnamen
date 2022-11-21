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
        Schema::create('pemains', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('tinggi_badan', $precision = 5, $scale = 2);
            $table->decimal('berat_badan', $precision = 5, $scale = 2);
            $table->enum('posisi', ['penyerang', 'gelandang','bertahan','penjaga gawang']);
            $table->integer('nomor_punggung');
            $table->unsignedBigInteger('tim_id');
            $table->timestamps();
            //relation with tims table
            $table->foreign('tim_id')->references('id')->on('tims')->onDelete('cascade');
            //agar nomor punggung tidak sama dlm 1 tim
            $table->unique(['tim_id', 'nomor_punggung']);
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
        Schema::dropIfExists('pemains');
    }
};
