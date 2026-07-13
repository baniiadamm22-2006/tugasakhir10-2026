<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division; // Tambahkan ini
use App\Models\Employee; // Tambahkan ini

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisionIds = Division::pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            Employee::create([
                'division_id' => $divisionIds[array_rand($divisionIds)], // Pilih divisi acak
                'name' => 'Karyawan ' . $i,
                'role' => 'Staff IT',
                'performance_score' => rand(1, 5),
                'status' => 'Active',
            ]);
        }
    }
}
