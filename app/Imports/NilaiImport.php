<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Nilai;

class NilaiImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    protected $id_kelas;
    protected $semester;
    protected $tahun_id;
    protected $id_guru;

    public function __construct($id_kelas, $semester, $tahun_id, $id_guru)
    {
        $this->id_kelas = $id_kelas;
        $this->semester = $semester;
        $this->tahun_id = $tahun_id;
        $this->id_guru = $id_guru;
        
    }
    public function collection(Collection $collection)
    {
        //
        $indexKe = 1;


        foreach($collection as $row){
            if($indexKe > 1){

                $data['nisn']      = !empty($row[0]) ? $row[0] : '';
                $data['id_kelas']       =  $this->id_kelas;
                $data['kode_mapel']       = !empty($row[1]) ? $row[1] : '';
                $data['semester']       =  $this->semester;
                $data['tahun_id']       =  $this->tahun_id;
                $data['ulangan_1']       = !empty($row[2]) ? $row[2] : '';
                $data['uts']       = !empty($row[3]) ? $row[3] : '';
                $data['ulangan_2']       = !empty($row[4]) ? $row[4] : '';
                $data['uas']       = !empty($row[5]) ? $row[5] : '';
                $data['id_guru']       =  $this->id_guru;

                Nilai::create($data);
            }

            $indexKe++;
        }
    }
}
