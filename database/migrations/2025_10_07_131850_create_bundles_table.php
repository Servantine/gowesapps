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
    Schema::create('bundles', function (Blueprint $table) {
        $table->bigIncrements('id_bundle');
        $table->string('nama_bundle');
        $table->string('kesulitan'); // contoh: Mudah, Sedang, Sulit
        $table->integer('jarak'); // dalam kilometer atau meter
        $table->string('titik_kumpul');
        $table->string('gambar')->nullable();
        $table->string('kabupaten');
        // Laravel secara default menambahkan created_at dan updated_at
        // Jika tidak butuh, tambahkan $table->timestamps = false; di model
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundles');
    }
};
