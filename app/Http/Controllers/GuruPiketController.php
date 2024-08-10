<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Absen;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Catatan;
use App\Models\Jadwal;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use App\Models\PesertaDidik;

class GuruPiketController extends Controller
{
    //
    public function loadKegiatanGuruPiket()
    {
        $kegiatan = Kegiatan::latest()->paginate(8);
        return response()->json($kegiatan);
    }
    public function dashboard(){
        return view('guru.guru-piket.dashboard');
    }


    //menu absen
    public function dataAbsen(Request $request)
    {
        $kelas = Kelas::all();
        $mapel = Mapel::all(); // Ambil semua mapel
        $data = collect(); // Kosongkan data siswa saat pertama kali membuka halaman
        $absensi = collect();
        $tanggal = null;
        $tahun = TahunAjaran::all();
        $id_kelas = $request->id_kelas;
        $id_mapel = $request->id_mapel;
        $semester = $request->semester;
        $tahun_id = $request->tahun_id; // Tambahkan variabel id_mapel

        // Jika ada pencarian
        if ($request->has('id_kelas')) {
            $mapel = Mapel::where('id_kelas', $request->id_kelas)->get();
        }
        if ($request->has('id_kelas') && $request->has('tgl') && $request->has('id_mapel') 
        && $request->has('tahun_id') && $request->has('semester')) {
            $data = PesertaDidik::where('id_kelas', $request->id_kelas)->get();
                $tanggal = $request->tgl;
                $id_mapel = $request->id_mapel;
                $semester = $request->semester;
                $tahun_id = $request->tahun_id;
                $id_kelas = $request->id_kelas;


            // Ambil data absensi berdasarkan tanggal dan mapel
            $absensi = Absen::whereDate('tgl', $tanggal)
                            ->where('id_mapel', $id_mapel)
                            ->where('semester', $semester)
                            ->where('tahun_id', $tahun_id)
                            ->where('id_kelas', $id_kelas)
                            ->whereIn('id_peserta', $data->pluck('id'))
                            ->get()->keyBy('id_peserta');
        }

        return view('guru.guru-piket.data-absen', compact('data', 'kelas', 'mapel', 'absensi', 'tanggal','tahun'));
    }

    public function searchAbsen(Request $request)
    {
        return redirect()->route('data-absen-peserta', [
            'semester' => $request->semester, 
            'tahun_id' => $request->tahun_id,
            'id_kelas' => $request->id_kelas,
            'tgl' => $request->tgl,
            'id_mapel' => $request->id_mapel, // Tambahkan parameter id_mapel
        ]);
    }

    public function setelahAbsen(Request $request)
    {
        return redirect()->route('data-absen-peserta', [
            'semester' => $request->semester, 
            'tahun_id' => $request->tahun_id,
            'id_kelas' => $request->id_kelas,
            'tgl' => $request->tgl,
            'id_mapel' => $request->id_mapel, // Tambahkan parameter id_mapel
        ])->with('success', 'Absen berhasil dilakukan.');
    }

    public function getMapelKelas($id_kelas)
    {
       // Mengakses kode_mapel melalui relasi guru
        $mapel = Mapel::where('id_kelas', $id_kelas)->get();
        return response()->json($mapel);
    }

    public function inputAbsen(Request $request){
        $userId = Auth::id();
        $guruId = Guru::where('id_user', $userId)->value('id');
        $tgl = $request->tgl;
        $id_mapel = $request->id_mapel;
        $tahun_id = $request->tahun_id;
        $semester = $request->semester;
    
        foreach ($request->selected_peserta as $id_peserta) {
            $data = new Absen;
            $data->id_peserta = $id_peserta;
            $data->id_kelas = $request->id_kelas;
            $data->tahun_id = $tahun_id;
            $data->semester = $semester;
            $data->id_guru = $guruId;
            $data->id_mapel = $id_mapel;
            $data->tgl = $tgl;
            $data->status = $request->input('status_' . $id_peserta);
            $data->save();
        }
    
        return redirect()->route('setelah-absen-peserta', [
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $tahun_id,
            'semester' => $semester,
            'tgl' => $tgl,
            'id_mapel' => $id_mapel,
        ])->with('success', 'Absen berhasil dilakukan.');
    }

    public function updateAbsen(Request $request, $id){

        $data = Absen::find($id);
        $data->status = $request->status;
        $data->update();
        return redirect()->back()->with('success', 'Absensi berhasil diperbarui');
    }

// catatan ngaji
    public function catatanNgaji(Request $request)
    {
        $kelas = Kelas::all();
        $tahun = TahunAjaran::all();
        $data = collect(); // Kosongkan data siswa saat pertama kali membuka halaman
        $id_kelas = $request->id_kelas;

        // Jika ada pencarian
        if ($request->has('id_kelas')) {
            $data = PesertaDidik::where('id_kelas', $id_kelas)
                                ->get();
        }

        return view('guru.guru-piket.catatan-ngaji', compact('data', 'kelas','tahun'));
    }

    public function searchCatatanNgaji(Request $request)
    {
        return redirect()->route('catatan-ngaji-guru-piket', [
            'id_kelas' => $request->id_kelas,
        ]);
    }

       public function lihatCatatan($nisn, $id_kelas, $tahun_id, $semester)
    {
        // Mengambil data pesanan berdasarkan ID
        $kelas = Kelas::find($id_kelas);
        $peserta = PesertaDidik::where('NISN', $nisn)->first();
        $tahunAjar = TahunAJaran::where('id', $tahun_id)->first();
    
        // Mengambil semua mapel untuk kelas tertentu
        $catatan = Catatan::where('nisn',$nisn)
                            ->where('id_kelas', $id_kelas)
                            ->where('tahun_id', $tahun_id)
                            ->where('semester', $semester)
                            ->get();
    
        return view('guru.guru-piket.lihat-catatan', compact('peserta','catatan', 'kelas','tahunAjar','semester'));
    }

    public function tambahCatatan(Request $request){

        $userId = Auth::id();

        $guruId = Guru::where('id_user', $userId)->value('id');
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            
        ], $message);
        
        $data = new Catatan;
        $data->nisn = $request->nisn;
        $data->id_guru = $guruId;
        $data->id_kelas = $request->id_kelas;
        $data->tahun_id = $request->tahun_id;
        $data->semester = $request->semester;
        $data->juz_surat = $request->juz_surat;
        $data->hal = $request->hal;
        $data->ayat = $request->ayat;
        $data->ket = $request->ket;
        $data->save($attributes);
        return redirect()->route('lihat-catatan-ngaji', [
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
        ])->with('success', 'Catatan Ngaji berhasil dilakukan.');
    }

    public function updateCatatan(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
        ];

        $this->validate($request, [
           
        ], $message);

        $data = Catatan::find($id);
        $data->juz_surat = $request->juz_surat;
        $data->hal = $request->hal;
        $data->ayat = $request->ayat;
        $data->ket = $request->ket;
        $data->update();
        return redirect()->route('lihat-catatan-ngaji', [
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
        ])->with('success', 'Catatan Ngaji berhasil diubah.');
    }

    public function dataJadwal(Request $request)
    {
        $id_guru = auth()->user()->guru->id;
        $tahun = TahunAjaran::all();
        $tahun_id = $request->tahun_id;
    
        $query = Jadwal::join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
            ->join('guru AS guru_inti', 'jadwal.id_guru', '=', 'guru_inti.id')
            ->leftJoin('guru AS guru_piket', 'jadwal.id_guruPiket', '=', 'guru_piket.id')
            ->leftJoin('mata_pelajaran AS mapel1', 'jadwal.id_mapel', '=', 'mapel1.id')
            ->leftJoin('mata_pelajaran AS mapel2', 'jadwal.id_mapel1', '=', 'mapel2.id')
            ->leftJoin('mata_pelajaran AS mapel3', 'jadwal.id_mapel2', '=', 'mapel3.id')
            ->select(
                'jadwal.*', 
                'guru_inti.nama_guru AS guru_inti', 
                'guru_piket.nama_guru AS guru_piket', 
                'mapel1.mapel AS nama_mapel1', 
                'mapel2.mapel AS nama_mapel2', 
                'mapel3.mapel AS nama_mapel3'
            )
            ->where('jadwal.id_guruPiket', $id_guru);
    
        if (!empty($tahun_id)) {
            $query->where('jadwal.id_ta', $tahun_id);
        }
    
        $data = $query->get();
    
        return view('guru.guru-piket.data-jadwal', compact('data', 'tahun'));
    }
    
    
    public function searchJadwal(Request $request)
    {
        return redirect()->route('data-jadwal-piket', [
            'tahun_id' => $request->tahun_id,
        ]);
    }
}
