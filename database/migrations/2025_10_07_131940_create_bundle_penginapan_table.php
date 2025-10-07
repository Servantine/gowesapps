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
    Schema::create('bundle_penginapan', function (Blueprint $table) {
        $table->bigIncrements('id_bp');
        $table->unsignedBigInteger('id_bundle');
        $table->unsignedBigInteger('id_penginapan');

        $table->foreign('id_bundle')->references('id_bundle')->on('bundles')->onDelete('cascade');
        $table->foreign('id_penginapan')->references('id_penginapan')->on('penginapans')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundle_penginapan');
    }
};
