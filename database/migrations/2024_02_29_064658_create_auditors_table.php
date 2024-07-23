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
        Schema::create('auditors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // foreign key ke tabel 'users'
            $table->unsignedBigInteger('id_audit'); // Kolom untuk foreign key ke tabel 'audits'
            $table->string('nama');
            $table->string('jabatan');
            $table->timestamps();

            // Tambahkan constraint foreign key ke tabel 'audits'
            $table->foreign('id_audit')->references('id')->on('audits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditors');
    }
};
