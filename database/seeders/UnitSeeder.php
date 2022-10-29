<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $units = [
            'pusdatin',
            'akademik',
            'lppm',
            'lpm',
            'kepegawaian',
            'marketing dan dokumentasi',
            'spi',
            'lhkk'
        ];

        foreach($units as $unit) {
            Unit::create([
                'unit_name' => $unit
            ]);
        }
    }
}
