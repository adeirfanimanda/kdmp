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
        Schema::create('member_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->enum('document_type', ['ktp', 'kk', 'npwp', 'salary_slip', 'selfie_photo', 'other']); // Jenis dokumen
            $table->string('file_name'); // Nama file
            $table->string('file_path'); // Path file
            $table->timestamp('uploaded_at'); // Waktu upload
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_documents');
    }
};
