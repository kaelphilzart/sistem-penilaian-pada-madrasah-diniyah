<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $fillable = ['nisn','id_kelas','semester','tahun_id','kode_mapel','ulangan_1','uts','ulangan_2','uas','id_guru'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}
