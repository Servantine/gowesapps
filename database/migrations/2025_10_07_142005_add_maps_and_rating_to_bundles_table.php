<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bundles', function (Blueprint $table) {
            $table->string('link_maps')->nullable()->after('kabupaten');
            $table->string('gambar_thumbnail_maps')->nullable()->after('link_maps');
            $table->decimal('rating', 2, 1)->nullable()->default(0.0)->after('gambar_thumbnail_maps'); // Contoh: 4.5
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bundles', function (Blueprint $table) {
            $table->dropColumn(['link_maps', 'gambar_thumbnail_maps', 'rating']);
        });
    }
};