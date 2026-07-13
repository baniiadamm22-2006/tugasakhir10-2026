<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'division_id' => 'required',
            'created_at'  => 'required|date', // Tambahkan validasi tanggal
        ]);

        // Jika tidak ada input tanggal, gunakan waktu sekarang
        $data = $validated;
        if (!isset($data['created_at'])) {
            $data['created_at'] = now();
        }

        Complaint::create($data);
        return back()->with('success', 'Keluhan berhasil dikirim.');
    }
}