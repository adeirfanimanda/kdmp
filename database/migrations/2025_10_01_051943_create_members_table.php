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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperative_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('member_number')->unique(); // Nomor anggota
            $table->string('nik')->unique(); // Nomor Induk Kependudukan
            $table->string('full_name'); // Nama lengkap
            $table->string('birth_place'); // Tempat lahir
            $table->date('birth_date'); // Tanggal lahir
            $table->enum('gender', ['male', 'female']); // Jenis kelamin
            $table->text('address'); // Alamat
            $table->string('phone'); // Nomor telepon
            $table->string('occupation')->nullable(); // Pekerjaan
            $table->string('education')->nullable(); // Pendidikan
            $table->decimal('monthly_income', 15, 2)->nullable(); // Penghasilan bulanan
            $table->string('emergency_contact_name'); // Nama kontak darurat
            $table->string('emergency_contact_phone'); // Telepon kontak darurat
            $table->enum('membership_status', ['active', 'inactive', 'suspended', 'resigned'])->default('active'); // Status keanggotaan
            $table->date('join_date')->nullable(); // Tanggal bergabung
            $table->date('resign_date')->nullable(); // Tanggal keluar
            $table->string('profile_photo')->nullable(); // Foto profil
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
