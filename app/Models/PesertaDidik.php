<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;

class PesertaDidik extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kelas', 'id_angkatan','nisn', 'nama_peserta', 'alamat_peserta','ttl_peserta','no_hp_peserta',
                                'nama_ayah','nama_ibu','foto','status'];


    public function catatan()
        {
            return $this->hasOne(Catatan::class, 'nisn');
        }

    public function kelas()
        {
            return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
        }
    
    public function angkatan()
        {
            return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id');
        }
}
