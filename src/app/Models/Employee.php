<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'division_id', 
        'name', 
        'role', 
        'whatsapp_number',
        'performance_score', 
        'status'
    ];

    public function division(): BelongsTo 
    {
        return $this->belongsTo(Division::class);
    }

    // Tambahan Relasi Ke Keluhan
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'employee_id');
    }

    // Fungsi Hitung Otomatis Berdasarkan Keluhan
    public function recalculatePerformanceScore(): void
    {
        // Default skor awal adalah 100 jika tidak ada keluhan
        $skorAkhir = 100; 

        // Ambil semua keluhan milik karyawan ini
        $allComplaints = $this->complaints()->get();

        foreach ($allComplaints as $complaint) {
            $pengurang = 0;

            // Cek tingkat prioritas keluhan (Menyesuaikan kolom 'priority' di database kamu)
            if ($complaint->priority === 'High') { 
                $pengurang = 10;
            } elseif ($complaint->priority === 'Medium') {
                $pengurang = 5;
            } else {
                $pengurang = 2;
            }

            // Cek status keluhan. Jika sudah 'Selesai', ringankan pengurangannya
            if ($complaint->status === 'Selesai') {
                $pengurang = $pengurang * 0.5; // Potongan dikurangi 50% jika sudah selesai
            }

            $skorAkhir -= $pengurang;
        }

        // Update & simpan hasil akhir ke kolom performance_score
        $this->performance_score = max(0, $skorAkhir); // Skor minimal adalah 0
        $this->save();
    }
}