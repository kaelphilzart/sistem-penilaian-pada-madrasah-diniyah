<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Profile;
use App\Models\Catatan;
use App\Models\PesertaDidik;
use App\Models\Mapel;
use App\Models\Absen;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WaliMuridController extends Controller
{
    //
    public function loadKegiatan()
    {
        $kegiatan = Kegiatan::latest()->paginate(8);
        return response()->json($kegiatan);
    }

    public function dashboard(){
        return view('wali-murid.dashboard');
    }

    public function isiProfile(){
        return view('wali-murid.isi-profile');
    }

    public function profile(){
        // Mengambil ID user yang sedang login
        $id_user = auth()->user()->id;
    
       
        $peserta = Profile::join('users', 'profile.id_user', '=', 'users.id')
                            ->where('users.id', $id_user)
                            ->join('peserta_didik','profile.nisn','=','peserta_didik.nisn')
                            ->select('peserta_didik.*')
                            ->first();
    
      
        if(!$peserta){
        
            return view('wali-murid.isi-profile');
        }
    
      
        return view('wali-murid.profile', compact('peserta'));
    }

    public function inputProfile(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
        ];

        $attributes = request()->validate([
           'nisn' => ['required', 'max:50', Rule::unique('profile', 'nisn')],
        ], $message);
        
        $id_user = auth()->user()->id;

        $data = new Profile;
        $data->id_user = $id_user;
        $data->nisn = $request->nisn;
        $data->save($attributes);
        return redirect('/dashboard_waliMurid')->with('success', 'karyawab berhasil disimpan');
    }

    public function jadwal(){
        // Mengambil ID user yang sedang login
        $id_user = auth()->user()->id;
    
        // Mengambil data jadwal
        $jadwal = Profile::join('users', 'profile.id_user', '=', 'users.id')
                            ->where('users.id', $id_user)
                            ->join('peserta_didik', 'profile.nisn', '=', 'peserta_didik.nisn')
                            ->join('jadwal', 'peserta_didik.id_kelas', '=', 'jadwal.id_kelas')
                            ->leftJoin('mata_pelajaran as mapel1', 'jadwal.id_mapel', '=', 'mapel1.id')
                            ->leftJoin('mata_pelajaran as mapel2', 'jadwal.id_mapel1', '=', 'mapel2.id')
                            ->leftJoin('mata_pelajaran as mapel3', 'jadwal.id_mapel2', '=', 'mapel3.id')
                            ->select(
                                'jadwal.hari',
                                DB::raw('IF(jadwal.id_mapel = 0, "Tidak ada", mapel1.mapel) as nama_mapel1'),
                                DB::raw('IF(jadwal.id_mapel1 = 0, "Tidak ada", mapel2.mapel) as nama_mapel2'),
                                DB::raw('IF(jadwal.id_mapel2 = 0, "Tidak ada", mapel3.mapel) as nama_mapel3')
                            )
                            ->get();
    
        // Mengambil data tahun ajaran
        $tahun = Profile::join('users', 'profile.id_user', '=', 'users.id')
                            ->where('users.id', $id_user)
                            ->join('peserta_didik', 'profile.nisn', '=', 'peserta_didik.nisn')
                            ->join('kelas', 'peserta_didik.id_kelas', '=', 'kelas.id')
                            ->select('kelas.*')
                            ->first();
    
        // Jika jadwal tidak ditemukan, arahkan ke halaman isi-profile
    
        // Mengirim data jadwal dan tahun ajaran ke view
        return view('wali-murid.jadwal', compact('jadwal', 'tahun'));
    }
    
    public function catatanNgaji(){
        // Mengambil ID user yang sedang login
        $id_user = auth()->user()->id;
    
       
        $nisn = Profile::join('users', 'profile.id_user', '=', 'users.id')
                            ->where('users.id', $id_user)
                            ->select('profile.nisn')
                            ->first();

        $catatan = Catatan::where('nisn',$nisn)->get();
    
        return view('wali-murid.catatan-ngaji', compact('catatan'));
    }

    public function pengaturanAkun(){
        // Mengambil ID user yang sedang login
        $id_user = auth()->user()->id;
    
       
        $user = Profile::join('users', 'profile.id_user', '=', 'users.id')
                            ->where('users.id', $id_user)
                            ->select('users.*','profile.nisn')
                            ->first();
    
      
        return view('wali-murid.pengaturan-akun', compact('user'));
    }

    public function ubahUser(Request $request){
        $id_user = auth()->user()->id;

        $data = User::find($id_user);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->update();
        return redirect('/dashboard_waliMurid')->with('success', 'berhasil memperbarui akun');
    }

    public function raport()
    {
        // Mengambil ID user yang sedang login
        $id_user = auth()->user()->id;
    
        $kelas = Kelas::all();

        $tahun = TahunAjaran::all();
    
        $anak = PesertaDidik::join('profile', 'peserta_didik.nisn', '=', 'profile.nisn')
                    ->join('users', 'profile.id_user', '=', 'users.id')
                    ->where('users.id', $id_user)
                    ->select('peserta_didik.*')
                    ->first();
    
        return view('wali-murid.raport', compact('kelas', 'anak', 'tahun'));
    }

    public function showRaport($nisn, $id_kelas, $tahun_id, $semester)
    {
        // Ambil data dari database
        $peserta = PesertaDidik::where('peserta_didik.nisn', $nisn)->first();
        $tahunAjaran = TahunAjaran::where('id', $tahun_id)->first();
    
        $id_Peserta = PesertaDidik::where('nisn', $nisn)->select('peserta_didik.id')->first();
    
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
                        ->whereIn('absen.status', ['izin', 'sakit', 'alfa'])
                        ->select('absen.status', DB::raw('count(*) as total'))
                        ->groupBy('absen.status')
                        ->pluck('total', 'status');
    
        // Buat array default dengan nilai 0 untuk status izin, sakit, dan alfa
        $defaultStatuses = [
            'izin' => 0,
            'sakit' => 0,
            'alfa' => 0,
        ];
    
        $absenData = array_merge($defaultStatuses, $absen->toArray());
    
        $kepalaMadrasah = User::where('level', 'kepalaMadrasah')
                      ->orderBy('created_at', 'desc')
                      ->first();
    
        // Load view 'guru.tampilan-raport' dengan data yang diberikan
        return view('wali-murid.tampilan-raport', compact('peserta', 'nilaiMapel', 'absenData', 'kepalaMadrasah','semester', 'tahunAjaran', 'catatan'));
    }
    
}
