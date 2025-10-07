<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel bundles
            $table->foreignId('bundle_id')->constrained('bundles', 'id_bundle')->onDelete('cascade');
            $table->string('nama')->default('Anonim');
            $table->unsignedTinyInteger('rating'); // Angka 1-5
            $table->text('feedback'); // Isi komen
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};