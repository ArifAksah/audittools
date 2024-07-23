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
        Schema::create('jadwalauditsp2a', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_audit');
            $table->string('nama_kegiatan');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();

            $table->foreign('id_audit')->references('id')->on('audits')->onDelete('cascade');
            // Menambahkan foreign key ke tabel audits dengan onDelete cascade
            // Artinya jika sebuah audit dihapus, semua jadwal audit SP2A yang terkait juga akan dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwalauditsp2a');
    }
};
