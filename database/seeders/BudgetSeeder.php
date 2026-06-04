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
        $divisions = Division::all()->keyBy('name');

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
        $catMkt = BudgetCategory::firstOrCreate(['code' => 'MKT-01'], ['name' => 'Promosi & Iklan']);
        $catLegal = BudgetCategory::firstOrCreate(['code' => 'LEG-01'], ['name' => 'Legal & Perizinan']);
        $catRnD = BudgetCategory::firstOrCreate(['code' => 'RND-01'], ['name' => 'Riset & Eksperimen']);
        $catCS = BudgetCategory::firstOrCreate(['code' => 'CS-01'], ['name' => 'Layanan Pelanggan']);

        $budgets = [];
        
        $addBudget = function($divName, $catId, $name, $total, $used, $start, $end) use (&$budgets, $divisions, $fiscalYear, $adminUser) {
            $div = $divisions->get($divName);
            if ($div) {
                $budgets[] = [
                    'fiscal_year_id' => $fiscalYear->id,
                    'budget_category_id' => $catId,
                    'division_id' => $div->id,
                    'name' => $name,
                    'total_amount' => $total,
                    'used_amount' => 0, // Direset ke 0, akan diisi presisi oleh ReimbursementSeeder
                    'start_date' => $start,
                    'end_date' => $end,
                    'created_by' => $adminUser->id,
                ];
            }
        };

        // IT
        $addBudget('IT & Development', $catIT->id, 'Anggaran IT & Infrastruktur Q1 2026', 50000000, 12500000, '2026-01-01', '2026-03-31');
        $addBudget('IT & Development', $catIT->id, 'Lisensi Software Tahunan', 150000000, 140000000, '2026-01-01', '2026-12-31');
        
        // Keuangan
        $addBudget('Keuangan', $catTaktis->id, 'Dana Taktis Keuangan 2026', 100000000, 85000000, '2026-01-01', '2026-12-31');
        $addBudget('Keuangan', $catOps->id, 'Operasional Divisi Keuangan Q1', 20000000, 5000000, '2026-01-01', '2026-03-31');

        // Operasional
        $addBudget('Operasional', $catOps->id, 'Anggaran Operasional Cabang', 200000000, 120000000, '2026-01-01', '2026-12-31');
        $addBudget('Operasional', $catOps->id, 'Pemeliharaan Gedung Q2', 75000000, 10000000, '2026-04-01', '2026-06-30');

        // HRD
        $addBudget('HRD', $catHR->id, 'Anggaran Rekrutmen & Pelatihan', 75000000, 15000000, '2026-01-01', '2026-06-30');
        $addBudget('HRD', $catOps->id, 'Kesejahteraan Karyawan', 120000000, 30000000, '2026-01-01', '2026-12-31');

        // Pemasaran & Penjualan
        $addBudget('Pemasaran', $catMkt->id, 'Kampanye Digital Q1', 80000000, 75000000, '2026-01-01', '2026-03-31');
        $addBudget('Pemasaran', $catMkt->id, 'Event Pameran Nasional', 150000000, 0, '2026-07-01', '2026-09-30');
        $addBudget('Penjualan', $catOps->id, 'Biaya Perjalanan Dinas Sales', 100000000, 45000000, '2026-01-01', '2026-12-31');

        // Legal & CS & R&D
        $addBudget('Legal & Compliance', $catLegal->id, 'Perpanjangan Izin Usaha', 30000000, 25000000, '2026-01-01', '2026-12-31');
        $addBudget('Customer Service', $catCS->id, 'Peningkatan Layanan Pelanggan', 40000000, 12000000, '2026-01-01', '2026-12-31');
        $addBudget('Riset & Pengembangan', $catRnD->id, 'Prototipe Produk Baru', 250000000, 180000000, '2026-01-01', '2026-12-31');

        foreach ($budgets as $budgetData) {
            Budget::firstOrCreate(
                ['name' => $budgetData['name']],
                $budgetData
            );
        }
    }
}
