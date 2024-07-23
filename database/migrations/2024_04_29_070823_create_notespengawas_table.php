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
        Schema::create('notespengawas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lhap');
            $table->foreign('id_lhap')->references('id')->on('lhap')->onDelete('cascade');
            $table->string('nama_pengawas');
            $table->string('nama_ketuatim');
            $table->json('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notespengawas');
    }
};
