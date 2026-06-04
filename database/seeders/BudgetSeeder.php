<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Division;
use App\Models\FiscalYear;
use App\Models\BudgetCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BudgetSeeder extends Seeder
{
    public function run(): void
    {
        $divIT = Division::where('name', 'IT & Development')->first();
        $divKeuangan = Division::where('name', 'Keuangan')->first();
        $divOperasional = Division::where('name', 'Operasional')->first();
        $divHRD = Division::where('name', 'HRD')->first();
        $divPemasaran = Division::where('name', 'Pemasaran')->first();
        $divCS = Division::where('name', 'Customer Service')->first();

        $adminUser = User::first();

        if (!$adminUser) {
            $this->command->error('User tidak ditemukan! Pastikan UserSeeder dijalankan lebih dulu.');
            return;
        }

        $fiscalYear = FiscalYear::firstOrCreate(
            ['year' => '2026'],
            [
                'is_active' => true,
                'start_date' => Carbon::create(2026, 1, 1)->format('Y-m-d'),
                'end_date' => Carbon::create(2026, 12, 31)->format('Y-m-d'),
            ]
        );

        $catIT = BudgetCategory::firstOrCreate(['code' => 'IT-01'], ['name' => 'Infrastruktur & IT']);
        $catTaktis = BudgetCategory::firstOrCreate(['code' => 'FIN-01'], ['name' => 'Dana Taktis']);
        $catOps = BudgetCategory::firstOrCreate(['code' => 'OPS-01'], ['name' => 'Operasional Cabang']);
        $catHR = BudgetCategory::firstOrCreate(['code' => 'HR-01'], ['name' => 'Pengembangan SDM']);
        $catMkt = BudgetCategory::firstOrCreate(['code' => 'MKT-01'], ['name' => 'Pemasaran & Iklan']);

        if ($divIT && $divKeuangan && $divOperasional && $divHRD) {
            $budgets = [
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catIT->id,
                    'division_id' => $divIT->id,
                    'name' => 'Anggaran IT & Infrastruktur Q1 2026',
                    'total_amount' => 50000000,
                    'used_amount' => 0,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-03-31',
                    'created_by' => $adminUser->id,
                ],
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catTaktis->id,
                    'division_id' => $divKeuangan->id,
                    'name' => 'Dana Taktis Keuangan 2026',
                    'total_amount' => 100000000,
                    'used_amount' => 0,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-12-31',
                    'created_by' => $adminUser->id,
                ],
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catOps->id,
                    'division_id' => $divOperasional->id,
                    'name' => 'Anggaran Operasional Cabang 2026',
                    'total_amount' => 250000000,
                    'used_amount' => 0,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-12-31',
                    'created_by' => $adminUser->id,
                ],
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catOps->id,
                    'division_id' => $divOperasional->id,
                    'name' => 'Anggaran Maintenance Q2',
                    'total_amount' => 50000000,
                    'used_amount' => 0,
                    'start_date' => '2026-04-01',
                    'end_date' => '2026-06-30',
                    'created_by' => $adminUser->id,
                ],
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catHR->id,
                    'division_id' => $divHRD->id,
                    'name' => 'Anggaran Rekrutmen & Pelatihan',
                    'total_amount' => 85000000,
                    'used_amount' => 0,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-12-31',
                    'created_by' => $adminUser->id,
                ],
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catMkt->id,
                    'division_id' => $divPemasaran->id ?? $divOperasional->id,
                    'name' => 'Kampanye Digital Q1',
                    'total_amount' => 120000000,
                    'used_amount' => 0,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-03-31',
                    'created_by' => $adminUser->id,
                ],
                [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catOps->id,
                    'division_id' => $divCS->id ?? $divOperasional->id,
                    'name' => 'Peningkatan Layanan Pelanggan',
                    'total_amount' => 45000000,
                    'used_amount' => 0,
                    'start_date' => '2026-01-01',
                    'end_date' => '2026-12-31',
                    'created_by' => $adminUser->id,
                ],
            ];

            foreach ($budgets as $budgetData) {
                Budget::firstOrCreate(
                    ['name' => $budgetData['name']],
                    $budgetData
                );
            }
        }
    }
}
