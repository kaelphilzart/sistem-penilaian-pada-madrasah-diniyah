<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;
    protected $table = 'angkatan';
    protected $primaryKey = 'id';
    protected $fillable = ['angkatan'];

    public function pesertaDidik()
    {
        return $this->hasMany(PesertaDidik::class, 'id_angkatan');
    }
}
