<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DivisionController extends Controller
{
    public function show(Request $request, $id)
    {

        
        // 1. Ambil input bulan (default ke bulan ini jika tidak ada)
        $selectedMonth = $request->get('month', date('Y-m'));
        $year  = date('Y', strtotime($selectedMonth));
        $month = date('m', strtotime($selectedMonth));

        // 2. Ambil data divisi dengan relasi yang difilter berdasarkan bulan
        $division = Division::with([
            'employees' => function($query) use ($year, $month) {
                $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            },
            'complaints' => function($query) use ($year, $month) {
                $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
            }
        ])->findOrFail($id);

        // 3. Hitung keluhan aktif berdasarkan bulan terpilih
        $division->active_complaints_count = $division->complaints()
            ->where('status', '!=', 'Resolved')
            ->count();

        // 4. Ambil list divisi untuk sidebar
        $divisiList = Division::all();
        View::share('divisiList', $divisiList);

        // 5. Kirim data ke view
        return view('division_detail', [
            'division'      => $division,
            'selectedMonth' => $selectedMonth
        ]);
    }
}


