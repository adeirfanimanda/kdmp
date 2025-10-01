<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Ambil Banten (code: 36)
    $banten = Province::where('code', '36')->first();

    if (!$banten) {
      $this->command->error('Province Banten not found. Please run ProvinceSeeder first.');
      return;
    }

    $regencies = [
      ['code' => '3601', 'name' => 'Pandeglang'],
      ['code' => '3602', 'name' => 'Lebak'],
      ['code' => '3603', 'name' => 'Tangerang'],
      ['code' => '3604', 'name' => 'Serang'],
      ['code' => '3671', 'name' => 'Kota Tangerang'],
      ['code' => '3672', 'name' => 'Kota Cilegon'],
      ['code' => '3673', 'name' => 'Kota Serang'],
      ['code' => '3674', 'name' => 'Kota Tangerang Selatan'],
    ];

    foreach ($regencies as $regency) {
      Regency::create([
        'code' => $regency['code'],
        'name' => $regency['name'],
        'province_id' => $banten->id,
      ]);
    }
  }
}
