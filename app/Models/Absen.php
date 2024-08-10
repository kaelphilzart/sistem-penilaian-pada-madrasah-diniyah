<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = 'absen';
    protected $primaryKey = 'id';
    protected $fillable = ['id_peserta', 'id_kelas', 'tahun_id', 'semester','id_guru', 'id_mapel','status','tgl'];
}
