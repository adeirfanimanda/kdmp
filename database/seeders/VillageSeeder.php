<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Ambil Kecamatan Sukadiri (code: 360310)
    $sukadiri = District::where('code', '360310')->first();

    if (!$sukadiri) {
      $this->command->error('District Sukadiri not found. Please run DistrictSeeder first.');
      return;
    }

    $villages = [
      ['code' => '3603102001', 'name' => 'Kosambi'],
      ['code' => '3603102002', 'name' => 'Sukadiri'],
      ['code' => '3603102003', 'name' => 'Sukatani'],
      ['code' => '3603102004', 'name' => 'Sukamantri'],
      ['code' => '3603102005', 'name' => 'Sukajadi'],
      ['code' => '3603102006', 'name' => 'Sukamulya'],
    ];

    foreach ($villages as $village) {
      Village::create([
        'code' => $village['code'],
        'name' => $village['name'],
        'district_id' => $sukadiri->id,
      ]);
    }
  }
}
