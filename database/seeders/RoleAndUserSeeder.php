<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Division;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        // Ambil semua divisi dari database
        $divisions = Division::all()->keyBy('name');

        $divIT = $divisions->get('IT & Development');

        $admin = User::firstOrCreate(
            ['email' => 'admin@syncbudget.com'],
            [
                'name' => 'Felix Admin',
                'password' => Hash::make('password123'),
                'division_id' => $divIT ? $divIT->id : null,
            ]
        );
        $admin->assignRole($adminRole);

        // Data Manajer
        $managersData = [
            ['email' => 'manager.keuangan@syncbudget.com', 'name' => 'Budi Santoso', 'division' => 'Keuangan'],
            ['email' => 'manager.it@syncbudget.com', 'name' => 'Andi Wijaya', 'division' => 'IT & Development'],
            ['email' => 'manager.hrd@syncbudget.com', 'name' => 'Siti Aminah', 'division' => 'HRD'],
            ['email' => 'manager.ops@syncbudget.com', 'name' => 'Rina Kartika', 'division' => 'Operasional'],
            ['email' => 'manager.sales@syncbudget.com', 'name' => 'Doni Saputra', 'division' => 'Penjualan'],
        ];

        foreach ($managersData as $mData) {
            $div = $divisions->get($mData['division']);
            $mgr = User::firstOrCreate(
                ['email' => $mData['email']],
                [
                    'name' => $mData['name'],
                    'password' => Hash::make('password123'),
                    'division_id' => $div ? $div->id : null,
                ]
            );
            $mgr->assignRole($managerRole);
            
            // Berikan akses manager ke divisi mereka sendiri
            if ($div) {
                $mgr->managedDivisions()->syncWithoutDetaching([$div->id]);
            }
        }

        // Manajer Keuangan lama (untuk kompatibilitas login demo lama)
        $manager = User::firstOrCreate(
            ['email' => 'manager@syncbudget.com'],
            [
                'name' => 'Manajer Utama',
                'password' => Hash::make('password123'),
                'division_id' => $divisions->get('Keuangan') ? $divisions->get('Keuangan')->id : null,
            ]
        );
        $manager->assignRole($managerRole);
        $manager->managedDivisions()->syncWithoutDetaching($divisions->pluck('id')->toArray());

        // Data Staff
        $staffData = [
            ['email' => 'staff@syncbudget.com', 'name' => 'Staf Operasional', 'division' => 'Operasional'],
            ['email' => 'staffhrd@syncbudget.com', 'name' => 'Staf HRD', 'division' => 'HRD'],
            ['email' => 'agus.it@syncbudget.com', 'name' => 'Agus Pratama', 'division' => 'IT & Development'],
            ['email' => 'lina.it@syncbudget.com', 'name' => 'Lina Marlina', 'division' => 'IT & Development'],
            ['email' => 'dwi.keuangan@syncbudget.com', 'name' => 'Dwi Handayani', 'division' => 'Keuangan'],
            ['email' => 'eko.keuangan@syncbudget.com', 'name' => 'Eko Prasetyo', 'division' => 'Keuangan'],
            ['email' => 'sari.hrd@syncbudget.com', 'name' => 'Sari Indah', 'division' => 'HRD'],
            ['email' => 'bayu.ops@syncbudget.com', 'name' => 'Bayu Anggara', 'division' => 'Operasional'],
            ['email' => 'maya.ops@syncbudget.com', 'name' => 'Maya Sari', 'division' => 'Operasional'],
            ['email' => 'toni.pemasaran@syncbudget.com', 'name' => 'Toni Gunawan', 'division' => 'Pemasaran'],
            ['email' => 'rita.pemasaran@syncbudget.com', 'name' => 'Rita Sugiarti', 'division' => 'Pemasaran'],
            ['email' => 'yudi.cs@syncbudget.com', 'name' => 'Yudi Lesmana', 'division' => 'Customer Service'],
            ['email' => 'nia.cs@syncbudget.com', 'name' => 'Nia Ramadhani', 'division' => 'Customer Service'],
            ['email' => 'fajar.legal@syncbudget.com', 'name' => 'Fajar Sidik', 'division' => 'Legal & Compliance'],
            ['email' => 'ari.rnd@syncbudget.com', 'name' => 'Ari Wibowo', 'division' => 'Riset & Pengembangan'],
            ['email' => 'dimas.sales@syncbudget.com', 'name' => 'Dimas Andrean', 'division' => 'Penjualan'],
            ['email' => 'putri.sales@syncbudget.com', 'name' => 'Putri Ayu', 'division' => 'Penjualan'],
        ];

        foreach ($staffData as $sData) {
            $div = $divisions->get($sData['division']);
            $staff = User::firstOrCreate(
                ['email' => $sData['email']],
                [
                    'name' => $sData['name'],
                    'password' => Hash::make('password123'),
                    'division_id' => $div ? $div->id : null,
                ]
            );
            $staff->assignRole($staffRole);
        }
    }
}
