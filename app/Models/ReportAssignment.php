<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAssignment extends Model
{
    use HasFactory;

    protected $table = 'report_assignments';
    protected $primaryKey = 'id_penugasan';

    protected $fillable = [
        'id_laporan',
        'id_petugas',
        'id_admin',
        'waktu_ditugaskan',
        'catatan_admin',
        'estimasi_selesai',
    ];

    // Fungsi relasi utama
    public function wasteReport()
    {
        return $this->belongsTo(WasteReport::class, 'id_laporan', 'id_laporan');
    }

    // TAMBAHKAN INI: Alias relasi agar 'laporan' terbaca oleh controller
    public function laporan()
    {
        return $this->belongsTo(WasteReport::class, 'id_laporan', 'id_laporan');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id_pengguna');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_pengguna');
    }
}
