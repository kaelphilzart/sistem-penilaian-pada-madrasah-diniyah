<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;
    protected $table = 'catatan_ngaji';
    protected $primaryKey = 'id';
    protected $fillable = ['nisn', 'id_guru', 'id_kelas', 'tahun_id', 'semester' ,'juz_surat','hal','ayat','ket'];

    public function peserta()
    {
        return $this->belongsTo(PesertaDidik::class, 'nisn', 'nisn');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
}
