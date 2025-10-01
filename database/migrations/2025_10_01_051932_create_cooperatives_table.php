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
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_id')->constrained()->cascadeOnDelete();
            $table->string('legal_number')->unique(); // Nomor badan hukum koperasi
            $table->string('name'); // Nama koperasi
            $table->text('address'); // Alamat koperasi
            $table->string('phone'); // Nomor telepon
            $table->string('email'); // Email koperasi
            $table->date('established_date'); // Tanggal berdiri
            $table->string('logo')->nullable(); // Logo koperasi
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active'); // Status koperasi
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperatives');
    }
};
