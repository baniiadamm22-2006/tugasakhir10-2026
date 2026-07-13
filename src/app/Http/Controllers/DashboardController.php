<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Complaint;
use App\Models\Division;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input bulan dari request, default ke bulan saat ini
        $selectedMonth = $request->get('month', date('Y-m'));
        
        // Pecah untuk filter query
        $year  = date('Y', strtotime($selectedMonth));
        $month = date('m', strtotime($selectedMonth));

        $divisiList = Division::withCount('employees')->get();
        View::share('divisiList', $divisiList); 

        return view('dashboard', [
            'selectedMonth'    => $selectedMonth,
            'totalKaryawan'    => Employee::where('status', 'Active')->count(),
            
            // Perbaikan Logika: Jika rataKinerja null, tampilkan 0 agar tidak error
            'rataKinerja'      => Employee::whereYear('created_at', $year)
                                          ->whereMonth('created_at', $month)
                                          ->avg('performance_score') ?? 0,
                                          
            'keluhanHigh'      => Complaint::where('priority', 'High')
                                        ->where('status', '!=', 'Resolved')
                                        ->where('month_year', date('F Y', strtotime($selectedMonth)))
                                        ->count(),
                                          
            'divisiList'       => $divisiList,
            'urgentComplaints' => Complaint::with('division')
                                          ->where('priority', 'High')
                                          ->latest()
                                          ->take(5)
                                          ->get(),
        ]);
    }

    public function downloadLaporan(Request $request) 
    {
        $selectedMonth = $request->get('month', date('Y-m'));
        $year  = date('Y', strtotime($selectedMonth));
        $month = date('m', strtotime($selectedMonth));

        // PENTING: Pastikan kolom 'created_at' di database Anda memang berisi 
        // tanggal yang benar. Jika Anda menggunakan kolom khusus (misal: 'tanggal_masuk'),
        // ganti 'created_at' dengan nama kolom tersebut di bawah ini.
        $keluhanList = Complaint::where(
                        'month_year',
                        date('F Y', strtotime($selectedMonth))
                    )   ->get();

        $data = [
            'selectedMonth' => $selectedMonth,
            'divisiList'    => Division::with('employees')->get(),
            'keluhanList'   => $keluhanList,
            'date'          => date('d F Y')
        ];

        // Jika data kosong, Anda bisa menambahkan log atau return error
        // dd($keluhanList); // Uncomment baris ini untuk debug jika PDF tetap kosong

        $pdf = Pdf::loadView('kinerja', $data);
        return $pdf->download('Laporan_HRIS_' . $selectedMonth . '.pdf');
    }
}