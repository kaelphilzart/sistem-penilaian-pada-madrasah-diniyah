<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    protected $fillable = ['id_ta', 'id_mapel', 'id_mapel1','id_mapel2','id_guru','hari'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function mapel1()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }

    public function mapel2()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }

    public function mapel3()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }

    public function guruInti()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function guruPiket()
    {
        return $this->belongsTo(Guru::class, 'id_guruPiket');
    }

    
}
