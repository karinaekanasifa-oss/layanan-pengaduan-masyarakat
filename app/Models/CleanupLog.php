<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleanupLog extends Model
{
    use HasFactory;

    protected $table = 'cleanup_logs';
    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_laporan',
        'id_petugas',
        'status_perubahan',
        'foto_bukti', // Kolom untuk upload gambar bukti petugas
        'catatan_petugas',
        'waktu_pembaruan',
    ];

    public function wasteReport()
    {
        return $this->belongsTo(WasteReport::class, 'id_laporan', 'id_laporan');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id_pengguna');
    }
}
