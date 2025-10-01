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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperative_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Nama metode pembayaran
            $table->string('code')->unique(); // Kode metode pembayaran
            $table->enum('type', ['cash', 'bank_transfer', 'qris', 'ewallet', 'other']); // Jenis pembayaran
            $table->text('description')->nullable(); // Deskripsi metode pembayaran
            $table->json('account_details')->nullable(); // Detail akun (bank, e-wallet, dll)
            $table->boolean('is_active')->default(true); // Status aktif
            $table->boolean('requires_proof')->default(false); // Apakah perlu upload bukti
            $table->integer('display_order')->default(0); // Urutan tampilan
            $table->string('icon')->nullable(); // Icon metode pembayaran
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
