<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = ['TI', 'MKT', 'KEU', 'SDM', 'OPS', 'LGL', 'PJL'];
        
        foreach ($divisions as $name) {
            Division::create(['name' => $name]);
        }
    }
}
