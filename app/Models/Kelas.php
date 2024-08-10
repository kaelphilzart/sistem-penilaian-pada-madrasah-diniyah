<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kelas','id_guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function mapel()
    {
        return $this->hasOne(Mapel::class, 'id_kelas');
    }

    public function peserta()
    {
        return $this->hasOne(PesertaDIdik::class, 'id_kelas');
    }
}
