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
    public function up(): void
{
    Schema::create('restos', function (Blueprint $table) {
        $table->bigIncrements('id_resto');
        $table->string('nama_resto');
        $table->integer('harga_resto'); // Asumsi harga dalam bentuk angka
        $table->string('lokasi_resto');
        $table->string('gambar')->nullable();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restos');
    }
};
