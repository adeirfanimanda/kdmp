<?php

namespace Database\Seeders;

use App\Models\Cooperative;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Ambil koperasi pertama
    $cooperative = Cooperative::first();

    if (!$cooperative) {
      $this->command->error('Cooperative not found. Please run CooperativeSeeder first.');
      return;
    }

    // 1. Super Admin (cooperative_id = null, bisa akses semua)
    $superAdmin = User::create([
      'cooperative_id' => null, // Super admin tidak terikat koperasi
      'name' => 'Super Admin',
      'email' => 'superadmin@koperasi.co.id',
      'password' => Hash::make('password123'),
      'email_verified_at' => now(),
    ]);

    // 2. Admin Koperasi
    $cooperativeAdmin = User::create([
      'cooperative_id' => $cooperative->id,
      'name' => 'Admin Koperasi Kosambi',
      'email' => 'admin@koperasikosambi.co.id',
      'password' => Hash::make('password123'),
      'email_verified_at' => now(),
    ]);

    // 3. Member dengan User Account
    $memberUser = User::create([
      'cooperative_id' => $cooperative->id,
      'name' => 'Budi Santoso',
      'email' => 'budisantoso@koperasi.co.id',
      'password' => Hash::make('password123'),
      'email_verified_at' => now(),
    ]);

    // 4. Buat data member untuk user di atas
    $member = Member::create([
      'cooperative_id' => $cooperative->id,
      'user_id' => $memberUser->id,
      'member_number' => 'MBR-001-2024',
      'nik' => '3201234567890123',
      'full_name' => 'Budi Santoso',
      'birth_place' => 'Bandung',
      'birth_date' => '1990-05-15',
      'gender' => 'male',
      'address' => 'Jl. Raya Kosambi No. 789, Desa Kosambi, Kecamatan Sukadiri, Kabupaten Tangerang',
      'phone' => '081234567890',
      'occupation' => 'Wiraswasta',
      'education' => 'S1',
      'monthly_income' => 5000000.00,
      'emergency_contact_name' => 'Siti Santoso',
      'emergency_contact_phone' => '081234567891',
      'membership_status' => 'active',
      'join_date' => '2024-01-01',
      'resign_date' => null,
      'profile_photo' => null,
    ]);

    // 5. Member tanpa User Account (hanya data member)
    $memberOnly = Member::create([
      'cooperative_id' => $cooperative->id,
      'user_id' => null, // Tidak punya akun login
      'member_number' => 'MBR-002-2024',
      'nik' => '3201234567890124',
      'full_name' => 'Siti Aminah',
      'birth_place' => 'Bandung',
      'birth_date' => '1985-08-20',
      'gender' => 'female',
      'address' => 'Jl. Raya Kosambi No. 321, Desa Kosambi, Kecamatan Sukadiri, Kabupaten Tangerang',
      'phone' => '081234567892',
      'occupation' => 'Ibu Rumah Tangga',
      'education' => 'SMA',
      'monthly_income' => 3000000.00,
      'emergency_contact_name' => 'Ahmad Aminah',
      'emergency_contact_phone' => '081234567893',
      'membership_status' => 'active',
      'join_date' => '2024-01-15',
      'resign_date' => null,
      'profile_photo' => null,
    ]);

    $this->command->info('Users created successfully:');
    $this->command->info('- Super Admin: superadmin@koperasi.co.id');
    $this->command->info('- Admin Koperasi: admin@koperasikosambi.co.id');
    $this->command->info('- Member User: budisantoso@koperasi.co.id');
    $this->command->info('- Member Only: Siti Aminah (no user account)');
    $this->command->info('Password for all users: password123');
  }
}
