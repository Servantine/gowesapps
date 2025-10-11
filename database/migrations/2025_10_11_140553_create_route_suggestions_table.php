<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->string('email_pengirim');
            $table->string('nama_rute');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->decimal('estimasi_jarak', 8, 2)->nullable(); // Jarak dalam KM, misal 15.50
            $table->enum('tingkat_kesulitan', ['Easy', 'Intermediate', 'Expert']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_suggestions');
    }
};