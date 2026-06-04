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
        $data = [
            ['div' => 'Operasional', 'title' => 'Pembelian Kertas HVS & Tinta Printer', 'desc' => 'Untuk keperluan cetak laporan bulanan operasional cabang.', 'amount' => 1500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Operasional', 'title' => 'Sewa Mobil Dinas Luar Kota', 'desc' => 'Kunjungan survei lapangan ke klien di Surabaya.', 'amount' => 3500000, 'status' => 'rejected', 'reject_reason' => 'Gunakan kendaraan operasional kantor yang sudah tersedia, tidak perlu sewa.'],
            ['div' => 'Operasional', 'title' => 'Restock Kopi & Snack Pantri', 'desc' => 'Kebutuhan konsumsi bulanan karyawan operasional.', 'amount' => 800000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'HRD', 'title' => 'Biaya Iklan Lowongan Kerja Premium', 'desc' => 'Pemasangan iklan loker di portal Jobstreet untuk 3 posisi IT.', 'amount' => 2500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'HRD', 'title' => 'Konsumsi Training Karyawan Baru', 'desc' => 'Makan siang untuk 15 peserta onboarding batch maret.', 'amount' => 1200000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'HRD', 'title' => 'Sewa Ruangan Hotel untuk Workshop', 'desc' => 'Training kepemimpinan manajerial.', 'amount' => 5000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'IT & Development', 'title' => 'Langganan Server AWS Bulanan', 'desc' => 'Tagihan cloud infrastructure bulan berjalan.', 'amount' => 8500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'IT & Development', 'title' => 'Pembelian Lisensi IDE JetBrains', 'desc' => 'Lisensi tahunan untuk 5 developer.', 'amount' => 12000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'IT & Development', 'title' => 'Penggantian Keyboard Mekanik Rusak', 'desc' => 'Keyboard fasilitas kantor untuk tim frontend.', 'amount' => 1500000, 'status' => 'rejected', 'reject_reason' => 'Bisa menggunakan stok keyboard standar di gudang.'],
            ['div' => 'Keuangan', 'title' => 'Biaya Konsultan Pajak Tahunan', 'desc' => 'Konsultasi penyusunan SPT Badan.', 'amount' => 15000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Keuangan', 'title' => 'Langganan Software Akuntansi Jurnal', 'desc' => 'Perpanjangan paket enterprise.', 'amount' => 6000000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'Pemasaran', 'title' => 'Biaya Ads Facebook & Instagram', 'desc' => 'Kampanye produk baru selama 2 minggu.', 'amount' => 20000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Pemasaran', 'title' => 'Cetak Brosur & Banner Event', 'desc' => 'Materi promosi untuk pameran JCC.', 'amount' => 4500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Pemasaran', 'title' => 'Sewa Jasa Influencer Lokal', 'desc' => 'Endorsement video TikTok 1 menit.', 'amount' => 10000000, 'status' => 'rejected', 'reject_reason' => 'Harga terlalu tinggi, cari alternatif influencer lain.'],
            ['div' => 'Customer Service', 'title' => 'Langganan Zendesk Customer Support', 'desc' => 'Biaya platform tiket bantuan.', 'amount' => 7500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Customer Service', 'title' => 'Pembelian Headset Noise Cancelling', 'desc' => 'Peralatan untuk agen call center.', 'amount' => 3000000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'Legal & Compliance', 'title' => 'Perpanjangan Izin Domisili Usaha', 'desc' => 'Pengurusan perizinan ke kelurahan dan kecamatan.', 'amount' => 2500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Legal & Compliance', 'title' => 'Biaya Notaris Perubahan Akta', 'desc' => 'Penyesuaian anggaran dasar perusahaan.', 'amount' => 8000000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'Riset & Pengembangan', 'title' => 'Pembelian Komponen IoT Prototipe', 'desc' => 'Sensor suhu dan modul WiFi untuk proyek Smart Office.', 'amount' => 4000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Riset & Pengembangan', 'title' => 'Biaya Uji Lab Independen', 'desc' => 'Pengujian keamanan bahan material.', 'amount' => 12000000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'Penjualan', 'title' => 'Entertainment Klien VIP', 'desc' => 'Makan malam bersama prospek klien besar di restoran bintang 5.', 'amount' => 3500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Penjualan', 'title' => 'Tiket Pesawat Jakarta-Bali', 'desc' => 'Perjalanan dinas tim sales untuk pitch project.', 'amount' => 5000000, 'status' => 'rejected', 'reject_reason' => 'Project di Bali belum fix, tunda perjalanan dinas.'],
            ['div' => 'Operasional', 'title' => 'Service AC Kantor Rutin', 'desc' => 'Cuci 10 unit AC di lantai 2 dan 3.', 'amount' => 1000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'IT & Development', 'title' => 'Upgrade RAM Server On-Premise', 'desc' => 'Pembelian 2 keping RAM 32GB ECC.', 'amount' => 6000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'HRD', 'title' => 'Paket Medical Check Up Karyawan', 'desc' => 'Cek kesehatan tahunan untuk 50 staf.', 'amount' => 25000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Pemasaran', 'title' => 'Pembelian Merchandise Kaos & Mug', 'desc' => 'Souvenir untuk pelanggan setia akhir tahun.', 'amount' => 15000000, 'status' => 'pending', 'reject_reason' => null],
            ['div' => 'Keuangan', 'title' => 'Pembelian Brankas Baru', 'desc' => 'Brankas anti api ukuran sedang.', 'amount' => 4500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Customer Service', 'title' => 'Gathering Internal Tim CS', 'desc' => 'Makan bersama tim bulanan untuk bonding.', 'amount' => 2000000, 'status' => 'rejected', 'reject_reason' => 'Budget bonding dialihkan ke event company outing tahunan.'],
            ['div' => 'Legal & Compliance', 'title' => 'Buku Referensi Hukum Terbaru', 'desc' => 'Pembelian buku KUHP dan perdata edisi revisi.', 'amount' => 500000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Penjualan', 'title' => 'Sewa Booth Pameran B2B', 'desc' => 'Pameran industri manufaktur di JIExpo.', 'amount' => 35000000, 'status' => 'approved', 'reject_reason' => null],
            ['div' => 'Riset & Pengembangan', 'title' => 'Buku Jurnal Akses Berbayar', 'desc' => 'Langganan IEEE Xplore untuk 1 bulan.', 'amount' => 1500000, 'status' => 'pending', 'reject_reason' => null],
        ];

        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                // Cari divisi berdasarkan nama
                $division = \App\Models\Division::where('name', $item['div'])->first();
                if (!$division) continue;

                // Cari staf secara acak di divisi ini
                $staff = User::where('division_id', $division->id)->whereHas('roles', function($q) {
                    $q->where('name', 'staff');
                })->inRandomOrder()->first();

                if (!$staff) continue;

                // Cari budget yang sesuai untuk divisi ini
                $budget = Budget::where('division_id', $division->id)->inRandomOrder()->first();
                if (!$budget) continue;

                // Cari manajer yang mengelola divisi ini
                $manager = User::whereHas('managedDivisions', function($q) use ($division) {
                    $q->where('divisions.id', $division->id);
                })->inRandomOrder()->first();

                // Jika tidak ada manajer spesifik, fallback ke manajer mana saja
                if (!$manager) {
                    $manager = User::whereHas('roles', function($q) {
                        $q->where('name', 'manager');
                    })->first();
                }

                $reimbursement = Reimbursement::firstOrCreate(
                    ['title' => $item['title']],
                    [
                        'user_id' => $staff->id,
                        'budget_id' => $budget->id,
                        'description' => $item['desc'],
                        'amount' => $item['amount'],
                        'status' => $item['status'],
                        'action_by' => in_array($item['status'], ['approved', 'rejected']) && $manager ? $manager->id : null,
                        'rejection_reason' => $item['reject_reason'],
                    ]
                );

                if ($reimbursement->wasRecentlyCreated && $reimbursement->status === 'approved') {
                    $budget->lockForUpdate()->increment('used_amount', $reimbursement->amount);
                }
            }
        });
    }
}
