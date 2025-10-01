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
        Schema::create('cooperative_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperative_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name'); // Nama bank
            $table->string('account_number'); // Nomor rekening
            $table->string('account_holder_name'); // Nama pemegang rekening
            $table->boolean('is_active')->default(true); // Status aktif rekening
            $table->boolean('is_primary')->default(false); // Rekening utama
            $table->text('description')->nullable(); // Deskripsi rekening
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperative_bank_accounts');
    }
};
