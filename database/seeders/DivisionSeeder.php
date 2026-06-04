<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            'IT & Development',
            'Keuangan',
            'HRD',
            'Operasional',
            'Pemasaran',
            'Customer Service',
            'Legal & Compliance',
            'Riset & Pengembangan',
            'Penjualan'
        ];

        foreach ($divisions as $division) {
            Division::firstOrCreate(['name' => $division]);
        }
    }
}
