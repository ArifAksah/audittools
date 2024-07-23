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
        Schema::create('lhap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kka')->constrained('kka_informations');
            $table->foreignId('id_user')->constrained('users');
            $table->text('kondisi_teks');
            $table->json('kondisi_image')->nullable();
            $table->text('kriteria_teks');
            $table->json('kriteria_image')->nullable();
            $table->text('sebab');
            $table->text('akibat');
            $table->json('rekomendasi')->nullable();
            $table->text('evidence')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users');
            $table->timestamp('update_terakhir_tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lhap');
    }
};
