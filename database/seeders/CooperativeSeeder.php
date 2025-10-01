<?php

namespace Database\Seeders;

use App\Models\Cooperative;
use App\Models\Village;
use Illuminate\Database\Seeder;

class CooperativeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Ambil Desa Kosambi
    $kosambi = Village::where('code', '3603102001')->first();

    if (!$kosambi) {
      $this->command->error('Village Kosambi not found. Please run VillageSeeder first.');
      return;
    }

    $cooperatives = [
      [
        'village_id' => $kosambi->id,
        'legal_number' => 'KOP.001/2024',
        'name' => 'Koperasi Desa Kosambi',
        'address' => 'Jl. Raya Kosambi No. 123, Desa Kosambi, Kecamatan Sukadiri, Kabupaten Tangerang',
        'phone' => '021-1234567',
        'email' => 'info@koperasikosambi.co.id',
        'established_date' => '2020-01-15',
        'logo' => null,
        'status' => 'active',
      ],
      [
        'village_id' => $kosambi->id,
        'legal_number' => 'KOP.002/2024',
        'name' => 'Koperasi Simpan Pinjam Merdeka Kosambi',
        'address' => 'Jl. Merdeka No. 456, Desa Kosambi, Kecamatan Sukadiri, Kabupaten Tangerang',
        'phone' => '021-7654321',
        'email' => 'admin@koperasimerdeka.co.id',
        'established_date' => '2018-03-20',
        'logo' => null,
        'status' => 'active',
      ],
    ];

    foreach ($cooperatives as $cooperative) {
      Cooperative::create($cooperative);
    }
  }
}
