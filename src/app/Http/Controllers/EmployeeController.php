<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Complaint;

class EmployeeController extends Controller
{


    public function index(Request $request)
{
    $selectedMonth = $request->get('month', date('Y-m'));

    // Pastikan kita memuat relasi 'employees' agar bisa dihitung avg-nya
    $divisiList = Division::with('employees')->get();
    
    $totalKaryawan = Employee::count();
    $rataKinerja = Employee::avg('performance_score');
    $keluhanHigh = Complaint::where('priority', 'High')->count();
    $urgentComplaints = Complaint::where('priority', 'High')->latest()->get();

    return view('dashboard', compact(
        'divisiList', 
        'selectedMonth', 
        'totalKaryawan', 
        'rataKinerja', 
        'keluhanHigh', 
        'urgentComplaints'
    ));
}

    public function show($id)
    {
        // Menampilkan detail divisi beserta karyawannya
        $division = Division::with('employees')->findOrFail($id);
        return view('division_detail', compact('division'));
    }
}




