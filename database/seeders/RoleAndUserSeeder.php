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

        $divIT = Division::where('name', 'IT & Development')->first();
        $divKeuangan = Division::where('name', 'Keuangan')->first();
        $divOperasional = Division::where('name', 'Operasional')->first();
        $divHRD = Division::where('name', 'HRD')->first();
        $divPemasaran = Division::where('name', 'Pemasaran')->first();
        $divCS = Division::where('name', 'Customer Service')->first();
        $divLegal = Division::where('name', 'Legal & Compliance')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@syncbudget.com'],
            [
                'name' => 'Felix',
                'password' => Hash::make('password123'),
                'division_id' => $divIT ? $divIT->id : null,
            ]
        );
        $admin->assignRole($adminRole);

        $manager = User::firstOrCreate(
            ['email' => 'manager@syncbudget.com'],
            [
                'name' => 'Manajer Keuangan',
                'password' => Hash::make('password123'),
                'division_id' => $divKeuangan ? $divKeuangan->id : null,
            ]
        );
        $manager->assignRole($managerRole);

        if ($manager && $divKeuangan && $divOperasional && $divHRD && $divPemasaran) {
            $managedDivisions = array_filter([
                $divKeuangan->id ?? null,
                $divOperasional->id ?? null,
                $divHRD->id ?? null,
                $divPemasaran->id ?? null,
                $divCS->id ?? null,
                $divLegal->id ?? null,
            ]);
            $manager->managedDivisions()->syncWithoutDetaching($managedDivisions);
        }

        $staff1 = User::firstOrCreate(
            ['email' => 'staff@syncbudget.com'],
            [
                'name' => 'Staf Operasional',
                'password' => Hash::make('password123'),
                'division_id' => $divOperasional ? $divOperasional->id : null,
            ]
        );
        $staff1->assignRole($staffRole);

        $staff2 = User::firstOrCreate(
            ['email' => 'staffhrd@syncbudget.com'],
            [
                'name' => 'Staf HRD',
                'password' => Hash::make('password123'),
                'division_id' => $divHRD ? $divHRD->id : null,
            ]
        );
        $staff2->assignRole($staffRole);
        
        $staff3 = User::firstOrCreate(
            ['email' => 'staffmarketing@syncbudget.com'],
            [
                'name' => 'Staf Pemasaran',
                'password' => Hash::make('password123'),
                'division_id' => $divPemasaran ? $divPemasaran->id : null,
            ]
        );
        $staff3->assignRole($staffRole);

        $staff4 = User::firstOrCreate(
            ['email' => 'staffcs@syncbudget.com'],
            [
                'name' => 'Staf CS',
                'password' => Hash::make('password123'),
                'division_id' => $divCS ? $divCS->id : null,
            ]
        );
        $staff4->assignRole($staffRole);
    }
}
