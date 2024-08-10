<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Guru;
use App\Models\TahunAjaran;
use App\Models\PesertaDidik;
use App\Models\Kelas;
use App\Models\Mapel;

class KepalaMadrasahController extends Controller
{
    //
    public function loadKegiatan()
    {
        $kegiatan = Kegiatan::latest()->paginate(8);
        return response()->json($kegiatan);
    }

    public function dashboard()
    {
        $jumlahGuru = Guru::count();
        $jumlahPeserta = PesertaDidik::count();
    
        $siswaMasukPertahun = PesertaDidik::selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
    
        $totalGuruPertahun = Guru::selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
    
        $tahunArray = [];
    
        foreach ($siswaMasukPertahun as $siswa) {
            if (!in_array($siswa->tahun, $tahunArray)) {
                $tahunArray[] = $siswa->tahun;
            }
        }
    
        foreach ($totalGuruPertahun as $guru) {
            if (!in_array($guru->tahun, $tahunArray)) {
                $tahunArray[] = $guru->tahun;
            }
        }
    
        sort($tahunArray);
    
        $labels = array_map(function($tahun) {
            return "Tahun Ajaran " . strval($tahun);
        }, $tahunArray);
    
        $siswaValues = [];
        $guruValues = [];
    
        foreach ($tahunArray as $tahun) {
            $siswaTahun = $siswaMasukPertahun->firstWhere('tahun', $tahun);
            $siswaValues[] = $siswaTahun ? $siswaTahun->jumlah : 0;
    
            $guruTahun = $totalGuruPertahun->firstWhere('tahun', $tahun);
            $guruValues[] = $guruTahun ? $guruTahun->jumlah : 0;
        }
    
        return view('kepala-madrasah.dashboard', compact('jumlahGuru', 'jumlahPeserta', 'labels', 'siswaValues', 'guruValues'));
    }
    
    
    

    public function dataGuru(Request $request){
        $status = $request->input('status');
        $total = Guru::count();
    
        $data = Guru::when($status, function ($query) use ($status) {
            $query->where('status', 'LIKE', "%$status%");
        })->get();
    
        return view('kepala-madrasah.data-guru', [
            'data' => $data, 
            'status' => $status, 
            'total' => $total
        ]);
    }
    
    public function filterGuru(Request $request)
    {
        // Redirect ke route data-mapel dengan parameter pencarian
        return redirect()->route('data-guru-kepala', ['status' => $request->input('status')]);
    }
    

    public function tahunMapel(){
        $data = Kelas::all();
        return view('kepala-madrasah.data-tahunMapel', ['data' => $data]);
    }

    public function mapel($id)
    {
        $tahun = Kelas::find($id);

        $mapel = Mapel::where('id_kelas',$id)
                        ->get();
                                 
        
        return view('kepala-madrasah.mapel', ['tahun' => $tahun, 'mapel' => $mapel]);
    }

    public function dataPeserta(Request $request)
    {
        $status = $request->input('status');
        $id_kelas = $request->input('id_kelas');
        $total = PesertaDidik::count();
        $kelas = Kelas::all();
    
        $data = PesertaDidik::when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($id_kelas, function ($query) use ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            })
            ->get();
    
        return view('kepala-madrasah.peserta', [
            'data' => $data,
            'status' => $status,
            'id_kelas' => $id_kelas,
            'total' => $total,
            'kelas' => $kelas
        ]);
    }
    
    public function filterPeserta(Request $request)
    {
        // Redirect ke route data-peserta-kepala dengan parameter pencarian
        return redirect()->route('data-peserta-kepala', [
            'status' => $request->input('status'),
            'id_kelas' => $request->input('id_kelas')
        ]);
    }
    

    public function peserta($id)
    {
        $tahun = Kelas::find($id);

        $peserta = PesertaDidik::join('kelas', 'peserta_didik.id_kelas', '=', 'kelas.id')
                                ->join('angkatan','peserta_didik.id_angkatan','=','angkatan.id')
                                ->where('id_kelas',$id)
                                ->select('peserta_didik.*',  'kelas.nama_kelas', 'angkatan.angkatan')
                                ->paginate(10);
                                 
        
        return view('kepala-madrasah.peserta', ['tahun' => $tahun, 'peserta' => $peserta]);
    }
}
