<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Complaint;
use App\Models\User;
use Carbon\Carbon;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $employees = Employee::all();

        if ($users->isEmpty() || $employees->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            $employee = $employees->random();
            $user = $users->random();
            
            // Generate tanggal acak dalam 3 bulan terakhir agar filter bulan bekerja
            $randomDate = Carbon::now()->subMonths(rand(0, 2))->subDays(rand(0, 20));
            
            Complaint::create([
                'user_id'     => $user->id,
                'division_id' => $employee->division_id,
                'title'       => 'Keluhan #' . $i,
                'description' => 'Deskripsi keluhan nomor ' . $i,
                'priority'    => ['Low', 'Medium', 'High'][rand(0, 2)],
                'status'      => ['Pending', 'Processed', 'Resolved'][rand(0, 2)],
                'created_at'  => $randomDate, 
                'updated_at'  => $randomDate,
            ]);
        }   
    }
}