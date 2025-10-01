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
        Schema::create('saving_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saving_account_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('saving_obligation_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('processed_by')->constrained('users')->cascadeOnDelete();
            $table->enum('transaction_type', ['deposit', 'obligation_payment', 'interest', 'withdrawal']); // Jenis transaksi
            $table->decimal('amount', 15, 2); // Jumlah transaksi
            $table->decimal('balance_before', 15, 2); // Saldo sebelum transaksi
            $table->decimal('balance_after', 15, 2); // Saldo setelah transaksi
            $table->foreignId('payment_method_id')->constrained()->cascadeOnDelete();
            $table->string('transfer_proof')->nullable(); // Bukti transfer
            $table->foreignId('cooperative_bank_account_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('member_bank_account_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('confirmation_status', ['pending', 'confirmed', 'rejected'])->default('pending'); // Status konfirmasi
            $table->text('description')->nullable(); // Deskripsi transaksi
            $table->string('reference_number')->nullable(); // Nomor referensi
            $table->date('transaction_date'); // Tanggal transaksi
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_transactions');
    }
};
