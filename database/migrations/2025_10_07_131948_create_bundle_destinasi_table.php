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
    Schema::create('bundle_destinasi', function (Blueprint $table) {
        $table->bigIncrements('id_bd');
        $table->unsignedBigInteger('id_bundle');
        $table->unsignedBigInteger('id_destinasi');

        $table->foreign('id_bundle')->references('id_bundle')->on('bundles')->onDelete('cascade');
        $table->foreign('id_destinasi')->references('id_destinasi')->on('destinasis')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundle_destinasi');
    }
};
