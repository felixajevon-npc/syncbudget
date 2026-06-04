<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReimbursementSeeder extends Seeder
{
    public function run(): void
    {
        $mainStaff = User::where('email', 'staff@syncbudget.com')->first();
        $mainManager = User::where('email', 'manager@syncbudget.com')->first();
        if (!$mainStaff || !$mainManager) return;

        // Templates for Operasional
        $opsTemplates = [
            ['title' => 'Pembelian Alat Tulis Kantor', 'desc' => 'Kebutuhan ATK cabang', 'amount' => 1500000],
            ['title' => 'Sewa Mobil Dinas', 'desc' => 'Kunjungan dinas luar kota', 'amount' => 3500000],
            ['title' => 'Restock Kopi & Snack', 'desc' => 'Konsumsi bulanan pantry', 'amount' => 800000],
            ['title' => 'Service AC Rutin', 'desc' => 'Perawatan rutin AC kantor', 'amount' => 1200000],
            ['title' => 'Beli Kursi Ergonomis', 'desc' => 'Penggantian kursi rusak', 'amount' => 2500000],
            ['title' => 'Tagihan Internet', 'desc' => 'Pembayaran ISP cabang', 'amount' => 3000000],
            ['title' => 'Biaya Kurir & Ekspedisi', 'desc' => 'Pengiriman dokumen penting', 'amount' => 500000],
            ['title' => 'Pembelian Air Galon', 'desc' => 'Stok air minum bulanan', 'amount' => 450000],
            ['title' => 'Perbaikan Pintu Kaca', 'desc' => 'Kaca lobi retak', 'amount' => 1800000],
            ['title' => 'Cetak Brosur & Spanduk', 'desc' => 'Materi operasional', 'amount' => 2200000],
            ['title' => 'Pembelian Tinta Printer', 'desc' => 'Stok tinta warna dan hitam', 'amount' => 950000],
            ['title' => 'Sewa Proyektor Tambahan', 'desc' => 'Meeting koordinasi triwulan', 'amount' => 1100000],
        ];

        $reimbursementsToCreate = [];

        // Generate 45 items for main staff
        for ($i = 1; $i <= 45; $i++) {
            $tpl = $opsTemplates[array_rand($opsTemplates)];
            $statusOptions = ['approved', 'approved', 'approved', 'rejected', 'rejected', 'pending', 'pending'];
            $status = $statusOptions[array_rand($statusOptions)];
            
            $reimbursementsToCreate[] = [
                'user' => $mainStaff,
                'title' => $tpl['title'] . ' Batch ' . $i,
                'desc' => $tpl['desc'],
                'amount' => $tpl['amount'] + rand(1, 9) * 100000,
                'status' => $status,
                'manager' => $mainManager,
            ];
        }

        // Add 15 "figuran" items for other users
        $otherStaffs = User::where('email', '!=', 'staff@syncbudget.com')->whereHas('roles', function($q) { $q->where('name', 'staff'); })->get();
        if ($otherStaffs->count() > 0) {
            for ($i = 1; $i <= 15; $i++) {
                $staff = $otherStaffs->random();
                $reimbursementsToCreate[] = [
                    'user' => $staff,
                    'title' => 'Pengeluaran Divisi ' . $i,
                    'desc' => 'Kebutuhan divisi untuk staf',
                    'amount' => rand(5, 50) * 100000,
                    'status' => ['approved', 'rejected', 'pending'][rand(0, 2)],
                    'manager' => $mainManager,
                ];
            }
        }

        DB::transaction(function () use ($reimbursementsToCreate) {
            $budgetUsage = []; // track usage per budget ID

            foreach ($reimbursementsToCreate as $item) {
                $staff = $item['user'];
                $budget = Budget::where('division_id', $staff->division_id)->inRandomOrder()->first();
                if (!$budget) continue;

                if (!isset($budgetUsage[$budget->id])) {
                    $budgetUsage[$budget->id] = 0; // Berawal dari 0 sesuai BudgetSeeder
                }

                $status = $item['status'];
                $amount = $item['amount'];

                // Mathematical cap logic (Max ~75%)
                if ($status === 'approved') {
                    $projectedUsage = $budgetUsage[$budget->id] + $amount;
                    $cap = $budget->total_amount * 0.75; 
                    if ($projectedUsage > $cap) {
                        // Switch to pending or rejected if it exceeds 75% budget
                        $status = rand(0, 1) ? 'pending' : 'rejected';
                    } else {
                        $budgetUsage[$budget->id] = $projectedUsage;
                    }
                }

                $reason = null;
                if ($status === 'rejected') {
                    $reasons = ['Budget sudah dialokasikan ke pos lain', 'Mohon sesuaikan dengan SOP', 'Harap lengkapi kuitansi', 'Gunakan vendor rekanan kantor', 'Ditolak karena tidak mendesak'];
                    $reason = $reasons[array_rand($reasons)];
                }

                Reimbursement::firstOrCreate(
                    ['title' => $item['title']],
                    [
                        'user_id' => $staff->id,
                        'budget_id' => $budget->id,
                        'description' => $item['desc'],
                        'amount' => $amount,
                        'status' => $status,
                        'action_by' => in_array($status, ['approved', 'rejected']) ? $item['manager']->id : null,
                        'rejection_reason' => $reason,
                    ]
                );
            }

            // After loop, bulk update budgets to exact used_amounts
            foreach ($budgetUsage as $budgetId => $usedAmount) {
                Budget::where('id', $budgetId)->update(['used_amount' => $usedAmount]);
            }
        });
    }
}
