<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Absen;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\PesertaDidik;
use App\Models\Catatan;
use PDF; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Excel;
use App\Imports\NilaiImport;

class GuruController extends Controller
{
    //
    public function loadKegiatanGuru()
    {
        $kegiatan = Kegiatan::latest()->paginate(8);
        return response()->json($kegiatan);
    }
    public function dashboard(){
        return view('guru.dashboard');
    }

    // public function dataSiswa(){
    //     $userId = Auth::id();
        
    //     // Mengambil id_guru dari relasi Guru dengan User
    //     $guruId = Guru::where('id_user', $userId)->value('id');
        
    //     // Menyaring data peserta didik yang memiliki id_tahun yang sama dengan id_TA pada tabel jadwal
    //     $data = PesertaDidik::join('tahun_ajaran', 'peserta_didik.id_tahun', '=', 'tahun_ajaran.id')
    //                          ->join('angkatan', 'peserta_didik.id_angkatan', '=', 'angkatan.id')
    //                          ->whereIn('peserta_didik.id_tahun', function($query) use ($guruId) {
    //                              $query->select('id_TA')
    //                                    ->from('jadwal')
    //                                    ->where('jadwal.id_guru', $guruId);
    //                          })
    //                          ->select('peserta_didik.*', 'tahun_ajaran.tahun', 'tahun_ajaran.semester', 'tahun_ajaran.kelas', 'angkatan.angkatan')
    //                          ->paginate(5);
        
    //     return view('guru.data-siswa', ['data' => $data]);
    // }

// peserta
    public function dataPeserta(Request $request)
    {
        $id_guru = auth()->user()->guru->id;
    
        $kelas = Kelas::where('id_guru', $id_guru)->get();
        $tahun = TahunAjaran::all();
    
        // Mendapatkan ID kelas pertama yang diajar oleh guru
        $kelasPertama = $kelas->first();
        $id_kelas = $request->get('id_kelas', $kelasPertama ? $kelasPertama->id : null);
    
        // Mengambil data siswa berdasarkan id_kelas
        $data = $id_kelas ? PesertaDidik::where('id_kelas', $id_kelas)->get() : collect();

        return view('guru.data-peserta', compact('data', 'kelasPertama'));
    }

    public function searchPeserta(Request $request)
    {
        return redirect()->route('data-peserta', [
            'id_tahun' => $request->id_tahun,
        ]);
    }



    public function dataJadwal(Request $request)
    {
        $id_guru = auth()->user()->guru->id;
        $tahun = TahunAjaran::all();
        $kelas = Kelas::where('id_guru', $id_guru)->get();
        
        $kelasPertama = $kelas->first();
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
                'mapel1.kode_mapel AS kode_mapel1', // Menambahkan kode_mapel1
                'mapel2.mapel AS nama_mapel2', 
                'mapel2.kode_mapel AS kode_mapel2', // Menambahkan kode_mapel2
                'mapel3.mapel AS nama_mapel3',
                'mapel3.kode_mapel AS kode_mapel3'  // Menambahkan kode_mapel3
            )
            ->where('jadwal.id_guru', $id_guru);
        
        if (!empty($tahun_id)) {
            $query->where('jadwal.id_ta', $tahun_id);
        }
        
        $data = $query->get();
        
        return view('guru.data-jadwal', compact('data', 'tahun', 'kelasPertama'));
    }
    
    
    
    public function searchJadwal(Request $request)
    {
        return redirect()->route('data-jadwal', [
            'tahun_id' => $request->tahun_id,
        ]);
    }
    
    

//absensi

    public function getMapelKelas($id_tahun)
    {
        $mapel = Mapel::where('id_thnAjaran', $id_tahun)->get();
        return response()->json($mapel);
    }

    public function dataAbsen(Request $request)
    {
        $id_guru = auth()->user()->guru->id;

        // Mendapatkan kelas yang pertama kali ditemukan untuk guru
        $kelas = Kelas::where('kelas.id_guru', $id_guru)
                    ->first();  // Hanya ambil kelas pertama
    
        $kelasPertama = $kelas->first();

        $data = collect(); // Kosongkan data siswa saat pertama kali membuka halaman
        $absensi = collect();
        $tanggal = null;
        $tahun = TahunAjaran::all();
        $mapel = Mapel::where('id_kelas', $kelas->id)->get();


        if ($kelas) {
            // Ambil mapel berdasarkan id_kelas
            if ($request->has('tgl') && $request->has('id_mapel') && $request->has('semester')) {
                $tanggal = $request->tgl;
                $id_mapel = $request->id_mapel;
                $semester = $request->semester;
                $tahun_id = $request->tahun_id;
                $id_kelas = $request->id_kelas;

                // Mengambil data siswa berdasarkan id_kelas
                $data = PesertaDidik::where('id_kelas', $kelas->id)->get();

                // Ambil data absensi berdasarkan tanggal, mapel, dan semester
                $absensi = Absen::whereDate('tgl', $tanggal)
                        ->where('id_mapel', $id_mapel)
                        ->where('semester', $semester)
                        ->where('tahun_id', $tahun_id)
                        ->where('id_kelas', $id_kelas)
                        ->whereIn('id_peserta', $data->pluck('id'))
                        ->get()->keyBy('id_peserta');
            }
        }

        return view('guru.data-absen', compact('data', 'kelas', 'mapel', 'absensi', 'tanggal','tahun','kelasPertama'));
    }
    
    
    public function searchAbsen(Request $request)
    {
        return redirect()->route('data-absen', [
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
            'tgl' => $request->tgl,
            'id_mapel' => $request->id_mapel, // Tambahkan parameter id_mapel
        ]);
    }

    public function setelahAbsen(Request $request)
    {
        return redirect()->route('data-absen', [
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
            'tgl' => $request->tgl,
            'id_mapel' => $request->id_mapel, // Tambahkan parameter id_mapel
        ])->with('success', 'Absen berhasil dilakukan.');
    }
    

    public function inputAbsen(Request $request){
        $userId = Auth::id();
        $guruId = Guru::where('id_user', $userId)->value('id');
        $tgl = $request->tgl;
        $id_mapel = $request->id_mapel;
        $tahun_id = $request->tahun_id;
        $semester = $request->semester;
    
        foreach ($request->selected_siswa as $id_peserta) {
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
    
        return redirect()->route('setelah-absen', [
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $tahun_id,
            'semester' => $semester,
            'tgl' => $tgl,
            'id_mapel' => $id_mapel,
        ])->with('success', 'Absen berhasil dilakukan.');
    }
    


    
    public function updateAbsen(Request $request, $id)
    {
        $data = Absen::find($id);
        $data->status = $request->status;
        $data->update();
    
        return redirect()->back()->with('success', 'Absensi berhasil diperbarui');
    }

// nilai
    public function importNilai(Request $request)
    {
        $id_guru = auth()->user()->guru->id;

        $import = new NilaiImport($request->id_kelas, $request->semester, $request->tahun_id, $id_guru);
        Excel::import($import, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Data nilai berhasil diimpor.');
    }

    public function nilai(Request $request)
    {
        $id_guru = auth()->user()->guru->id;
    
        $kelas = Kelas::where('id_guru', $id_guru)->get();
        $tahun = TahunAjaran::all();
    
        // Mendapatkan ID kelas pertama yang diajar oleh guru
        $kelasPertama = $kelas->first();
        $id_kelas = $request->get('id_kelas', $kelasPertama ? $kelasPertama->id : null);
    
        // Mengambil data siswa berdasarkan id_kelas
        $data = $id_kelas ? PesertaDidik::where('id_kelas', $id_kelas)->get() : collect();
    
        return view('guru.nilai', compact('data', 'kelasPertama', 'tahun'));
    }
    

    public function searchNilai(Request $request)
    {
        return redirect()->route('nilai', [
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
        ]);
    }



    public function dataNilai($nisn, $id_kelas, $tahun_id, $semester)
    {
        $kelas = Kelas::find($id_kelas);
        $peserta = PesertaDidik::where('NISN', $nisn)->first();
        $tahunAjar = TahunAJaran::where('id', $tahun_id)->first();
        
        $mataPelajaran = Mapel::where('id_kelas',$id_kelas)->get(); // Ambil semua mata pelajaran
    
        $nilai = Nilai::where('nilai.nisn', $nisn)
                        ->where('nilai.id_kelas', $id_kelas)
                        ->where('nilai.semester', $semester)
                        ->where('nilai.tahun_id', $tahun_id)
                        ->join('mata_pelajaran', 'nilai.kode_mapel', '=', 'mata_pelajaran.kode_mapel')
                        ->select('nilai.*', 'mata_pelajaran.mapel')
                        ->get();
    
        foreach ($nilai as $dataNilai) {
            $dataNilai->rata_rata = (
                $dataNilai->tugas_1 +
                $dataNilai->tugas_2 +
                $dataNilai->tugas_3 +
                $dataNilai->tugas_4 +
                $dataNilai->uts +
                $dataNilai->uas
            ) / 6;
        }
    
        // Gabungkan data nilai dengan mata pelajaran untuk memastikan semua mata pelajaran ada
        $nilaiLengkap = $mataPelajaran->map(function($mapel) use ($nilai) {
            $nilaiMapel = $nilai->firstWhere('kode_mapel', $mapel->kode_mapel);
            if (!$nilaiMapel) {
                return (object)[
                    'mapel' => $mapel->mapel,
                    'ulangan_1' => null,
                    'uts' => null,
                    'ulangan_2' => null,
                    'uas' => null,
                    'rata_rata' => null,
                ];
            }
            return $nilaiMapel;
        });
    
        return view('guru.data-nilai', compact('kelas', 'peserta', 'tahunAjar', 'semester', 'nilaiLengkap'));
    }
    
    
    
    public function filterMapel(Request $request)
    {
        $id_peserta = $request->input('id_peserta');
        $id_tahun = $request->input('id_tahun');
        $id_mapel = $request->input('id_mapel');
    
        $tahun = TahunAjaran::find($id_tahun);
        $peserta = PesertaDidik::find($id_peserta);
        $mapel = Mapel::where('id_thnAjaran', $id_tahun)->get();
    
        $nilaiQuery = Nilai::where('id_peserta', $id_peserta)
                            ->join('mata_pelajaran', 'nilai.id_mapel', '=', 'mata_pelajaran.id')
                            ->select('nilai.*', 'mata_pelajaran.mapel as nama_mapel');
    
        if ($id_mapel && $id_mapel != 'Filter Mapel') {
            $nilaiQuery->where('id_mapel', $id_mapel);
        }
    
        $nilai = $nilaiQuery->paginate(5);
    
        return view('guru.data-nilai', compact('tahun', 'mapel', 'nilai', 'peserta', 'id_peserta', 'id_tahun'));
    }

    public function inputNilai(Request $request){
        // Validasi form
        $message= [
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute harus berupa angka',
        ];

        $attributes = $request->validate([
            'id_peserta' => 'required',
            'id_mapel' => 'required',
            'nama_tugas' => 'required',
            'isi_nilai' => 'required|numeric',
        ], $message);

        // Pengecekan apakah data sudah ada
        $existingData = Nilai::where('id_peserta', $request->id_peserta)
                            ->where('id_mapel', $request->id_mapel)
                            ->where('nama_tugas', $request->nama_tugas)
                            ->first();

        if ($existingData) {
            // Jika data sudah ada, tampilkan pesan toast dan kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'Masukan nilai gagal karena anda sudah menginputkan untuk tugas ini');
        }

        // Jika data belum ada, simpan data baru
        $data = new Nilai;
        $data->id_peserta = $request->id_peserta;
        $data->id_mapel = $request->id_mapel;
        $data->nama_tugas = $request->nama_tugas;
        $data->isi_nilai = $request->isi_nilai;
        $data->save();

        return redirect()->route('data-nilai', [
            'id_peserta' => $request->id_peserta,
            'id_tahun' => $request->id_tahun
        ])->with('succes', 'Berhasil menginputkan nilai');
    }

    public function updateNilai(Request $request, $id)
    {
        // Validasi form
        $message= [
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute harus berupa angka',
        ];

        $attributes = $request->validate([
            'isi_nilai' => 'required|numeric',
        ], $message);

        // Ambil data yang ada berdasarkan id
        $data = Nilai::findOrFail($id);
        $data->isi_nilai = $request->isi_nilai;
        $data->save(); // Simpan perubahan

        return redirect()->route('data-nilai', [
            'id_peserta' => $request->id_peserta,
            'id_tahun' => $request->id_tahun
        ])->with('succes', 'Berhasil mengubah nilai');
    }

// rekap
    public function rekapNilai(Request $request)
    {
        $tahun = TahunAjaran::all();
        $data = collect(); // Kosongkan data siswa saat pertama kali membuka halaman
        $id_tahun = $request->id_tahun;

        // Jika ada pencarian
        if ($request->has('id_tahun')) {
            $data = PesertaDidik::join('tahun_ajaran', 'peserta_didik.id_tahun', '=', 'tahun_ajaran.id')
                                ->join('angkatan', 'peserta_didik.id_angkatan', '=', 'angkatan.id')
                                ->select('peserta_didik.*', 'tahun_ajaran.tahun', 'tahun_ajaran.semester', 'tahun_ajaran.kelas', 'angkatan.angkatan')
                                ->where('id_tahun', $id_tahun)
                                ->paginate(5);
        }

        return view('guru.rekap-nilai', compact('data', 'tahun'));
    }

    public function searchRekapNilai(Request $request)
    {
        return redirect()->route('rekap-nilai', [
            'id_tahun' => $request->id_tahun,
        ]);
    }

    public function lihatRekap($id_peserta, $id_tahun)
    {
        // Mengambil data tahun ajaran dan peserta didik
        $tahun = TahunAjaran::find($id_tahun);
        $peserta = PesertaDidik::find($id_peserta);
    
        // Mengambil semua mapel untuk tahun ajaran tertentu
        $mapel = Mapel::where('id_thnAjaran', $id_tahun)->get();
    
        // Mengambil semua jenis tugas yang ada
        $jenisTugas = Nilai::where('id_peserta', $id_peserta)
                            ->join('mata_pelajaran', 'nilai.id_mapel', '=', 'mata_pelajaran.id')
                            ->where('mata_pelajaran.id_thnAjaran', $id_tahun)
                            ->select('nilai.nama_tugas')
                            ->distinct()
                            ->pluck('nama_tugas')
                            ->toArray();
    
        // Mengambil data nilai dan mengelompokkan berdasarkan mapel dan jenis tugas
        $rekap = Nilai::where('id_peserta', $id_peserta)
                        ->join('mata_pelajaran', 'nilai.id_mapel', '=', 'mata_pelajaran.id')
                        ->where('mata_pelajaran.id_thnAjaran', $id_tahun)
                        ->select('nilai.*', 'mata_pelajaran.mapel')
                        ->get()
                        ->groupBy('mapel');
    
        // Hitung rata-rata per mata pelajaran
        $rataRata = $rekap->mapWithKeys(function ($nilaiMapel, $mapel) {
            $totalNilai = $nilaiMapel->sum('isi_nilai');
            $jumlahNilai = $nilaiMapel->count();
            $rata2 = $jumlahNilai ? $totalNilai / $jumlahNilai : 0;
            return [$mapel => $rata2];
        });
    
        return view('guru.lihat-rekap', compact('tahun', 'mapel', 'rekap', 'peserta', 'jenisTugas', 'rataRata'));
    }
    

// catatan ngaji
    public function catatanNgaji(Request $request)
    {
        $id_guru = auth()->user()->guru->id;
    
        $kelas = Kelas::where('id_guru', $id_guru)->get();
        $tahun = TahunAjaran::all();
    
        // Mendapatkan ID kelas pertama yang diajar oleh guru
        $kelasPertama = $kelas->first();
        $id_kelas = $request->get('id_kelas', $kelasPertama ? $kelasPertama->id : null);
    
        // Mengambil data siswa berdasarkan id_kelas
        $data = $id_kelas ? PesertaDidik::where('id_kelas', $id_kelas)->get() : collect();
    
        return view('guru.catatan-ngaji', compact('data', 'kelasPertama', 'tahun'));
    }

    public function searchCatatanNgaji(Request $request)
    {
        return redirect()->route('catatan-ngaji-guru', [
            'id_tahun' => $request->id_tahun,
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
    
        return view('guru.lihat-catatan', compact('peserta','catatan', 'kelas','tahunAjar','semester'));
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
        return redirect()->route('lihat-catatan', [
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
        return redirect()->route('lihat-catatan', [
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
        ])->with('success', 'Catatan Ngaji berhasil diubah.');
    }

    public function dataKegiatan(){
        $data = Kegiatan::paginate(5);
        return view('guru.data-kegiatan', ['data' => $data]);
    }

    public function lihatRaport($nisn, $id_kelas, $tahun_id, $semester)
    {
        // Ambil data dari database
        $peserta = PesertaDidik::where('peserta_didik.nisn', $nisn)->first();
        $tahunAjaran = TahunAjaran::where('id', $tahun_id)->first();
    
       
    
        if (!$peserta) {
            abort(404, 'Siswa tidak ditemukan');
        }
    
        // Ambil semua mapel untuk tahun ajaran tertentu
        $mapelTahunAjaran = Mapel::where('id_kelas', $id_kelas)->pluck('id');
    
        // Ambil semua nilai berdasarkan id_peserta dan mapelTahunAjaran
        $nilaiMapel = DB::table('mata_pelajaran')
                        ->leftJoin('nilai', function($join) use ($nisn, $id_kelas, $tahun_id, $semester) {
                            $join->on('mata_pelajaran.kode_mapel', '=', 'nilai.kode_mapel')
                                ->where('nilai.nisn', $nisn)
                                ->where('nilai.id_kelas', $id_kelas)
                                ->where('nilai.semester', $semester)
                                ->where('nilai.tahun_id', $tahun_id);
                        })
                        ->where('mata_pelajaran.id_kelas', $id_kelas)
                        ->select('mata_pelajaran.mapel', 'nilai.*', DB::raw('
                            (COALESCE(nilai.ulangan_1, 0) + COALESCE(nilai.uts, 0) + COALESCE(nilai.ulangan_2, 0) + COALESCE(nilai.uas, 0)) / 
                            NULLIF(
                                (CASE WHEN nilai.ulangan_1 IS NOT NULL THEN 1 ELSE 0 END +
                                CASE WHEN nilai.uts IS NOT NULL THEN 1 ELSE 0 END +
                                CASE WHEN nilai.ulangan_2 IS NOT NULL THEN 1 ELSE 0 END +
                                CASE WHEN nilai.uas IS NOT NULL THEN 1 ELSE 0 END), 0) as rata_rata
                        '))
                        ->get();
        
       $catatan = Catatan::where('nisn', $nisn)
                   ->where('id_kelas', $id_kelas)
                   ->where('tahun_id', $tahun_id)
                   ->where('semester', $semester)
                   ->orderBy('created_at', 'desc')
                   ->first();
                   
    $id_Peserta = PesertaDidik::where('nisn', $nisn)->select('id')->first()->id;

    $absen = Absen::where('id_peserta', $id_Peserta)
            ->where('id_kelas', $id_kelas)
            ->where('tahun_id', $tahun_id)
            ->where('semester', $semester)
            ->whereIn('status', ['izin', 'sakit', 'alfa'])
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

    // Array default dengan nilai 0 untuk setiap status
    $defaultStatuses = [
        'izin' => 0,
        'sakit' => 0,
        'alfa' => 0,
    ];

    // Menggabungkan hasil query dengan array default
    $absenData = array_merge($defaultStatuses, $absen->toArray());
    
        $kepalaMadrasah = User::where('level', 'kepalaMadrasah')
                      ->orderBy('created_at', 'desc')
                      ->first();
    
        // Load view 'guru.tampilan-raport' dengan data yang diberikan
        $pdf = PDF::loadView('guru.tampilan-raport', compact('peserta', 'nilaiMapel', 'absenData', 'kepalaMadrasah','semester', 'tahunAjaran', 'catatan'))
            ->setPaper('legal', 'portrait'); // Set ukuran kertas ke F4 (legal size)
    
        // Tampilkan PDF di browser tanpa mengunduh
        return $pdf->stream('RAPORT ' . $peserta->nama_peserta . ' kelas (' . $peserta->kelas . ').pdf');
    }
    
    
    
    
    
}
