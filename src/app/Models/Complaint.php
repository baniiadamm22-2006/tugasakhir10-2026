<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    // Menambahkan 'created_at' agar bisa diisi secara manual
    protected $fillable = [
        'employee_id', 
        'division_id', 
        'title', 
        'description', 
        'category', 
        'month_year', 
        'priority', 
        'status',
        'created_at' // <--- INI KUNCI SOLUSINYA
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function division(): BelongsTo
    { 
        return $this->belongsTo(Division::class); 
    }

    public function employee(): BelongsTo
    { 
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Pemicu Otomatis (Trigger) di Latar Belakang Filament
    protected static function booted(): void
    {
        // Berjalan otomatis saat keluhan baru ditambah atau di-update statusnya
        static::saved(function ($complaint) {
            if ($complaint->employee) {
                $complaint->employee->recalculatePerformanceScore();
            }
        });

        // Berjalan otomatis jika seandainya ada data keluhan yang dihapus
        static::deleted(function ($complaint) {
            if ($complaint->employee) {
                $complaint->employee->recalculatePerformanceScore();
            }
        });
    }
}



