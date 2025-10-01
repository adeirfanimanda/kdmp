<?php

namespace Database\Seeders;

use App\Models\Regency;
use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Ambil Kabupaten Tangerang (code: 3603)
    $tangerang = Regency::where('code', '3603')->first();

    if (!$tangerang) {
      $this->command->error('Regency Kabupaten Tangerang not found. Please run RegencySeeder first.');
      return;
    }

    $districts = [
      ['code' => '360301', 'name' => 'Balaraja'],
      ['code' => '360302', 'name' => 'Jayanti'],
      ['code' => '360303', 'name' => 'Tigaraksa'],
      ['code' => '360304', 'name' => 'Jambe'],
      ['code' => '360305', 'name' => 'Cisoka'],
      ['code' => '360306', 'name' => 'Kresek'],
      ['code' => '360307', 'name' => 'Kronjo'],
      ['code' => '360308', 'name' => 'Mauk'],
      ['code' => '360309', 'name' => 'Kemiri'],
      ['code' => '360310', 'name' => 'Sukadiri'],
      ['code' => '360311', 'name' => 'Rajeg'],
      ['code' => '360312', 'name' => 'Sepatan'],
      ['code' => '360313', 'name' => 'Sepatan Timur'],
      ['code' => '360314', 'name' => 'Pakuhaji'],
      ['code' => '360315', 'name' => 'Teluknaga'],
      ['code' => '360316', 'name' => 'Kosambi'],
      ['code' => '360317', 'name' => 'Pagedangan'],
      ['code' => '360318', 'name' => 'Cisauk'],
      ['code' => '360319', 'name' => 'Sukamulya'],
      ['code' => '360320', 'name' => 'Kelapa Dua'],
      ['code' => '360321', 'name' => 'Sindang Jaya'],
      ['code' => '360322', 'name' => 'Sepatan Utara'],
      ['code' => '360323', 'name' => 'Solear'],
      ['code' => '360324', 'name' => 'Gunung Kaler'],
      ['code' => '360325', 'name' => 'Mekar Baru'],
    ];

    foreach ($districts as $district) {
      District::create([
        'code' => $district['code'],
        'name' => $district['name'],
        'regency_id' => $tangerang->id,
      ]);
    }
  }
}
