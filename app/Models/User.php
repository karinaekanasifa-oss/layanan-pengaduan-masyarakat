<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'nama_lengkap',
    'email',
    'password',
    'no_telepon',
    'peran',
    'id_zona'
])]
#[Hidden([
    'password',
    'remember_token'
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_pengguna';

    // Relasi ke tabel Zona
    public function zona()
    {
        return $this->belongsTo(Zone::class, 'id_zona', 'id_zona');
    }

    // Tambahan relasi: Seorang pengguna (masyarakat) dapat mengirimkan banyak laporan sampah (WasteReport)
    public function wasteReports()
    {
        return $this->hasMany(WasteReport::class, 'id_pelapor', 'id_pengguna');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
