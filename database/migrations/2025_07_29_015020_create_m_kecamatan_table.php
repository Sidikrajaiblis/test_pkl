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
        Schema::create('m_kecamatan', function (Blueprint $table) {
            $table->id('id_kecamatan'); // auto increment
            $table->string('nama_kecamatan', 100);

            $table->unsignedBigInteger('id_kabupaten'); // tambahkan manual
            $table->foreign('id_kabupaten')->references('id_kabupaten')->on('m_kabupaten')->onDelete('cascade');

            $table->timestamps();

            $table->unique(['nama_kecamatan', 'id_kabupaten']); // validasi duplikasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kecamatan');
    }
};
