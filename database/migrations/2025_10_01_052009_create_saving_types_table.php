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
        Schema::create('saving_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperative_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Nama jenis tabungan
            $table->string('code')->unique(); // Kode jenis tabungan
            $table->decimal('minimum_amount', 15, 2)->default(0); // Jumlah minimum
            $table->boolean('is_mandatory')->default(false); // Apakah wajib
            $table->boolean('is_withdrawable')->default(true); // Apakah bisa ditarik
            $table->boolean('is_auto_generate_monthly')->default(false); // Auto generate bulanan
            $table->integer('monthly_due_date')->nullable(); // Tanggal jatuh tempo bulanan
            $table->text('description')->nullable(); // Deskripsi
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_types');
    }
};
