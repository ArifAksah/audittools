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
        Schema::create('audity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_audit');
            $table->string('departemen');
            // Tambahkan kolom lainnya sesuai kebutuhan

            // Tambahkan constraint foreign key
            $table->foreign('id_audit')->references('id')->on('audits')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audity');
    }
};
