<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';
    protected $primaryKey = 'id_zona'; // Karena pakai primary key custom

    protected $fillable = [
        'nama_zona',
        'deskripsi_wilayah',
        'id_laporan',
    ];
}
