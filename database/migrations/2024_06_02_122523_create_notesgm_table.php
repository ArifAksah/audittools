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
        Schema::create('notesgm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_audit');
            $table->unsignedBigInteger('id_lhap');
            $table->unsignedBigInteger('id_auditor');
            $table->string('status');
            $table->json('audit_kka');
            $table->string('nama_pengawas');
            $table->string('nama_ketuatim');
            $table->json('notes');
            $table->string('auditor_lhap');
            $table->timestamps();

            $table->foreign('id_lhap')->references('id')->on('lhap')->onDelete('cascade');
            // Add foreign key constraint for id_audit and id_auditor if they reference other tables
            $table->foreign('id_audit')->references('id')->on('audits')->onDelete('cascade');
            $table->foreign('id_auditor')->references('id')->on('auditors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notesgm');
    }
};
