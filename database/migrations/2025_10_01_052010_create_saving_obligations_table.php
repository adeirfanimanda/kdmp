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
        Schema::create('saving_obligations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('saving_type_id')->constrained()->cascadeOnDelete();
            $table->integer('period_year'); // Tahun periode
            $table->integer('period_month'); // Bulan periode
            $table->decimal('obligated_amount', 15, 2); // Jumlah yang wajib
            $table->decimal('paid_amount', 15, 2)->default(0); // Jumlah yang sudah dibayar
            $table->decimal('remaining_amount', 15, 2); // Jumlah sisa
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending'); // Status
            $table->date('paid_off_date')->nullable(); // Tanggal lunas
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_obligations');
    }
};
