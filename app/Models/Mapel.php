<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kelas', 'id_angkatan', 'kode_mapel','mapel'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function jadwal()
    {
        return $this->hasOne(Guru::class, 'id_mapel');
    }
}
