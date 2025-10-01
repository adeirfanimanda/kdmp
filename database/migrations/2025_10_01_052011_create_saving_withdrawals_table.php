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
        Schema::create('saving_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('saving_account_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2); // Jumlah penarikan
            $table->text('reason')->nullable(); // Alasan penarikan
            $table->foreignId('member_bank_account_id')->constrained()->cascadeOnDelete(); // Rekening tujuan
            $table->enum('status', ['requested', 'approved', 'rejected', 'disbursed'])->default('requested'); // Status
            $table->date('request_date'); // Tanggal permintaan
            $table->date('approval_date')->nullable(); // Tanggal persetujuan
            $table->foreignId('approved_by')->nullable()->constrained('users')->cascadeOnDelete(); // Yang menyetujui
            $table->text('approval_notes')->nullable(); // Catatan persetujuan
            $table->date('disbursement_date')->nullable(); // Tanggal pencairan
            $table->foreignId('disbursed_by')->nullable()->constrained('users')->cascadeOnDelete(); // Yang mencairkan
            $table->enum('disbursement_method', ['transfer', 'cash'])->nullable(); // Metode pencairan
            $table->string('bank_reference_number')->nullable(); // Nomor referensi bank
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_withdrawals');
    }
};
