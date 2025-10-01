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
        Schema::create('saving_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('saving_type_id')->constrained()->cascadeOnDelete();
            $table->string('account_number')->unique(); // Nomor rekening tabungan
            $table->decimal('balance', 15, 2)->default(0); // Saldo saat ini
            $table->decimal('total_deposits', 15, 2)->default(0); // Total setoran
            $table->decimal('total_withdrawals', 15, 2)->default(0); // Total penarikan
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_accounts');
    }
};
