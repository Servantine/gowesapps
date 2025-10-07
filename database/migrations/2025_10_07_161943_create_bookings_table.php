<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_id')->constrained('bundles', 'id_bundle');
            $table->string('nama_lengkap');
            $table->string('nomer_wa');
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->text('catatan')->nullable();
            $table->json('detail_pesanan'); // Menyimpan detail seperti paket, addons
            $table->unsignedBigInteger('total_harga');
            $table->string('metode_pembayaran'); // 'QRIS' atau 'Cash'
            $table->string('status_pembayaran')->default('pending'); // pending, paid, cancelled
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
        Schema::dropIfExists('bookings');
    }
};
