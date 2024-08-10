<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'Guru';
    protected $primaryKey = 'id';
    protected $fillable = ['id_user', 'kode_guru', 'nama_guru', 'alamat_guru', 'ttl_guru', 'no_hp_guru'];


    protected static function boot()
    {
        parent::boot();

        // Menambahkan event "creating" yang akan dijalankan saat menyimpan data baru
        static::creating(function ($member) {
            // Ambil ID terakhir dari tabel dan tambahkan 1 untuk menghasilkan angka unik berikutnya
            $lastId = static::max('id') ?? 0;
            $nextId = $lastId + 1;

            // Format kode member sesuai dengan MDHM_urutan
            $kodeGuru = 'MDHM_' . str_pad($nextId, 3, '00', STR_PAD_LEFT);

            // Tetapkan nilai kode guru yang telah digenerate ke kolom "kodeGuru"
            $member->kode_guru = $kodeGuru;
        });
}

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_guru');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id_guru');
    }

    public function catatan()
    {
        return $this->hasOne(Catatan::class, 'id_guru');
    }
}

