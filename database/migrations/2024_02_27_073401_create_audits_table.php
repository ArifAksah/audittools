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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('judul_audit');
            // Menambahkan kolom untuk kunci asing
            $table->unsignedBigInteger('id_bidangAudit');
            $table->foreign('id_bidangAudit')->references('id')->on('bidang_audit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
