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
        $staffOps = User::where('email', 'staff@syncbudget.com')->first();
        $staffHrd = User::where('email', 'staffhrd@syncbudget.com')->first();
        $manager = User::where('email', 'manager@syncbudget.com')->first();

        if (!$staffOps || !$staffHrd || !$manager) {
            return;
        }

        $budgetOps = Budget::where('division_id', $staffOps->division_id)->first();
        $budgetHrd = Budget::where('division_id', $staffHrd->division_id)->first();

        if (!$budgetOps || !$budgetHrd) {
            return;
        }

        $reimbursements = [
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Pembelian Kertas HVS & Tinta Printer',
                'description' => 'Untuk keperluan cetak laporan bulanan operasional cabang.',
                'amount' => 1500000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Sewa Mobil Dinas Luar Kota',
                'description' => 'Kunjungan survei lapangan ke klien di Surabaya.',
                'amount' => 3500000,
                'status' => 'rejected',
                'action_by' => $manager->id,
                'rejection_reason' => 'Gunakan kendaraan operasional kantor yang sudah tersedia, tidak perlu sewa.',
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Restock Kopi & Snack Pantri',
                'description' => 'Kebutuhan konsumsi bulanan karyawan operasional.',
                'amount' => 800000,
                'status' => 'pending',
                'action_by' => null,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffHrd->id,
                'budget_id' => $budgetHrd->id,
                'title' => 'Biaya Iklan Lowongan Kerja Premium',
                'description' => 'Pemasangan iklan loker di portal Jobstreet untuk 3 posisi IT.',
                'amount' => 2500000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffHrd->id,
                'budget_id' => $budgetHrd->id,
                'title' => 'Konsumsi Training Karyawan Baru',
                'description' => 'Makan siang untuk 15 peserta onboarding batch maret.',
                'amount' => 1200000,
                'status' => 'pending',
                'action_by' => null,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Pembayaran Tagihan Internet Cabang',
                'description' => 'Tagihan ISP bulanan untuk operasional cabang.',
                'amount' => 2500000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Service AC Ruangan Rapat',
                'description' => 'Perawatan rutin AC di 3 ruangan.',
                'amount' => 1200000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Penggantian Kursi Kerja Rusak',
                'description' => 'Pembelian 2 kursi ergonomis baru.',
                'amount' => 3000000,
                'status' => 'rejected',
                'action_by' => $manager->id,
                'rejection_reason' => 'Masih ada sisa kursi di gudang inventaris.',
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Pembelian Token Listrik',
                'description' => 'Token listrik cadangan untuk operasional server mini.',
                'amount' => 1000000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffHrd->id,
                'budget_id' => $budgetHrd->id,
                'title' => 'Sewa Ruangan Hotel untuk Workshop',
                'description' => 'Kegiatan workshop tahunan divisi HR.',
                'amount' => 8500000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Biaya Pengiriman Dokumen Ekspres',
                'description' => 'Pengiriman dokumen legal ke cabang di luar pulau.',
                'amount' => 450000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Langganan Software Manajemen Proyek',
                'description' => 'Perpanjangan lisensi 1 tahun untuk tim operasional.',
                'amount' => 12000000,
                'status' => 'pending',
                'action_by' => null,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffHrd->id,
                'budget_id' => $budgetHrd->id,
                'title' => 'Paket Medical Checkup',
                'description' => 'MCU tahunan untuk karyawan tetap.',
                'amount' => 25000000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Konsumsi Meeting Koordinasi',
                'description' => 'Makan siang untuk rapat evaluasi kuartal pertama.',
                'amount' => 1800000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Pembelian Seragam Karyawan Baru',
                'description' => 'Pemesanan 20 set seragam untuk cabang operasional.',
                'amount' => 7500000,
                'status' => 'pending',
                'action_by' => null,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffHrd->id,
                'budget_id' => $budgetHrd->id,
                'title' => 'Biaya Sertifikasi Trainer',
                'description' => 'Sertifikasi BNSP untuk 2 staf HRD.',
                'amount' => 10000000,
                'status' => 'rejected',
                'action_by' => $manager->id,
                'rejection_reason' => 'Ditunda ke kuartal berikutnya, budget saat ini difokuskan ke rekrutmen.',
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Perbaikan Pintu Kaca Lobi',
                'description' => 'Penggantian engsel dan kaca yang retak.',
                'amount' => 2200000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Pembelian Air Minum Galon',
                'description' => 'Stok air mineral bulanan.',
                'amount' => 450000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffHrd->id,
                'budget_id' => $budgetHrd->id,
                'title' => 'Langganan Portal Jurnal HR',
                'description' => 'Akses jurnal riset SDM selama setahun.',
                'amount' => 1500000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ],
            [
                'user_id' => $staffOps->id,
                'budget_id' => $budgetOps->id,
                'title' => 'Biaya Tol dan Parkir',
                'description' => 'Reimburse tol operasional kendaraan dinas minggu ini.',
                'amount' => 350000,
                'status' => 'approved',
                'action_by' => $manager->id,
                'rejection_reason' => null,
            ]
        ];

        DB::transaction(function () use ($reimbursements, $budgetOps, $budgetHrd) {
            foreach ($reimbursements as $data) {
                $reimbursement = Reimbursement::firstOrCreate(
                    ['title' => $data['title']],
                    $data
                );

                if ($reimbursement->wasRecentlyCreated && $reimbursement->status === 'approved') {
                    $budgetToUpdate = $reimbursement->budget_id === $budgetOps->id ? $budgetOps : $budgetHrd;
                    $budgetToUpdate->lockForUpdate()->increment('used_amount', $reimbursement->amount);
                }
            }
        });
    }
}
