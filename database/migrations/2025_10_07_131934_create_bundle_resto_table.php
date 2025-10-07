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
    Schema::create('bundle_resto', function (Blueprint $table) {
        $table->bigIncrements('id_br');
        $table->unsignedBigInteger('id_bundle');
        $table->unsignedBigInteger('id_resto');

        // Foreign key constraints
        $table->foreign('id_bundle')->references('id_bundle')->on('bundles')->onDelete('cascade');
        $table->foreign('id_resto')->references('id_resto')->on('restos')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundle_resto');
    }
};
