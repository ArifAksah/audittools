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
        Schema::create('nama_tabel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_audit');
            $table->unsignedBigInteger('id_user');
            $table->string('name');
            $table->text('signature')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_audit')->references('id')->on('audits')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
