<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteReport extends Model
{
    use HasFactory;

    protected $table = 'waste_reports';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_pelapor',
        'id_zona',
        'ulasan_warga',
        'jenis_sampah',
        'lokasi',
        'foto_kondisi_awal', // Kolom untuk upload gambar laporan 
        'status_laporan',
        'dibuat_pada',
    ];

    public function pelapor()
    {
        return $this->belongsTo(User::class, 'id_pelapor', 'id_pengguna');
    }

    public function zona()
    {
        return $this->belongsTo(Zone::class, 'id_zona', 'id_zona');
    }

    public function reportAssignments()
    {
        return $this->hasMany(ReportAssignment::class, 'id_laporan');
    }

    public function cleanupLogs()
    {
        return $this->hasMany(CleanupLog::class, 'id_laporan');
    }
}
