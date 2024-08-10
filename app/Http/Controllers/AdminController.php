<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Jadwal;
use App\Models\Catatan;
use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\Profile;
use App\Models\TahunAjaran;
use App\Models\PesertaDidik;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AkunWaliMail;
use Illuminate\Support\Facades\Validator;
use ConsoleTVs\Charts\Facades\Charts;

class AdminController extends Controller
{
    public function loadKegiatan()
    {
        $kegiatan = Kegiatan::latest()->paginate(8);
        return response()->json($kegiatan);
    }
    //
    public function dashboard()
    {
        // Mengambil jumlah siswa masuk per tahun
        $siswaMasukPertahun = PesertaDidik::selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
    
        // Inisialisasi array tahun
        $tahunArray = [];
    
        // Mengisi array dengan tahun dari siswa masuk
        foreach ($siswaMasukPertahun as $siswa) {
            if (!in_array($siswa->tahun, $tahunArray)) {
                $tahunArray[] = $siswa->tahun;
            }
        }
    
        // Urutkan array tahun
        sort($tahunArray);
    
        // Menyiapkan data untuk ditampilkan di chart
        $labels = array_map('strval', $tahunArray);
        $siswaValues = [];
    
        foreach ($tahunArray as $tahun) {
            $siswaTahun = $siswaMasukPertahun->firstWhere('tahun', $tahun);
            $siswaValues[] = $siswaTahun ? $siswaTahun->jumlah : 0;
        }
    
        return view('admin.dashboard', compact('labels', 'siswaValues'));
    }


    public function dataUser(){
        $data = User::get();

        return view('admin.data-user', ['data' => $data]);
    }
    
    public function cariUser(Request $request)
    {
        $kataKunci = $request->input('q');
        $hasilPencarian = User::when($kataKunci, function ($query) use ($kataKunci) {
            $query->where('name', 'LIKE', "%$kataKunci%")
            ->orWhere('email', 'LIKE', "%$kataKunci%");
        })->paginate(5);

        return view('admin.data-user', ['data' => $hasilPencarian, 'kataKunci' => $kataKunci]);
    }

    public function createUser(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
        ], $message);
        
        $attributes['password'] = bcrypt($attributes['password'] );

        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->level = $request->level;
        $data->save($attributes);
        return redirect('/data-user')->with('success', 'Data berhasil disimpan');;
    }

    public function updateUser(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], $message);

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->update();
        return redirect('/data-user')->with('success', 'Pengguna berhasil diubah');;
    }
    
    public function deleteUser($id){
        $data = User::find($id);
        $data->delete();
        return redirect('/data-user')->with('success', 'Data berhasil dihapus');;
    }
    
//Guru
    public function dataGuru(Request $request){
        $kataKunci = $request->input('q');

        $data = Guru::when($kataKunci, function ($query) use ($kataKunci) {
            $query->where('nama_guru', 'LIKE', "%$kataKunci%")
                ->orWhere('kode_guru', 'LIKE', "%$kataKunci%");
        }) ->get();

        $data1 = User::where('level', 'guru')
        ->whereDoesntHave('guru')
        ->get(); 
        return view('admin.data-guru', ['data' => $data, 'data1' => $data1,   'kataKunci' => $kataKunci,]);
    }

    public function cariGuru(Request $request)
    {
        // Redirect ke route data-mapel dengan parameter pencarian
        return redirect()->route('data-guru', ['q' => $request->input('q')]);
    }

    public function tambahGuru(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            'id_user' => 'required|unique:guru',
            'nama_guru'=> 'required',
            'alamat_guru' => 'required',
            'ttl_guru' => 'required',
            'no_hp_guru' => 'required',
            'status' => 'required',
        ], $message);
        
        $data = new Guru;
        $data->id_user = $request->id_user;
        $data->nama_guru = $request->nama_guru;
        $data->alamat_guru = $request->alamat_guru;
        $data->ttl_guru = $request->ttl_guru;
        $data->no_hp_guru = $request->no_hp_guru;
        $data->status = $request->status;
        $data->save($attributes);
        return redirect('/data-guru')->with('success', 'Guru berhasil disimpan');
    }

    public function updateGuru(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'nama_guru' => 'required',
            'alamat_guru' => 'required',
            'ttl_guru' => 'required',
            'no_hp_guru' => 'required',
            'status' => 'required',
        ], $message);

        $data = Guru::find($id);
        $data->nama_guru = $request->nama_guru;
        $data->alamat_guru = $request->alamat_guru;
        $data->ttl_guru = $request->ttl_guru;
        $data->no_hp_guru = $request->no_hp_guru;
        $data->status = $request->status;
        $data->update();
        return redirect('/data-guru')->with('success', 'Guru berhasil diubah');;
    }

    public function deleteGuru($id){
        $data = Guru::find($id);
        $data->delete();
        return redirect('/data-guru')->with('success', 'Guru berhasil dihapus');;
    }

// kelas
    public function dataKelas(){

        $data = Kelas::all();

        $guru = Guru::where('status','guru_inti')->get();
        return view('admin.data-kelas', ['data' => $data,'guru' =>$guru ]);
    }


    public function tambahKelas(Request $request){
        
        $data = new Kelas;
        $data->nama_kelas = $request->nama_kelas;
        $data->id_guru = $request->id_guru;
        $data->save();
        return redirect('/data-kelas')->with('success', 'Kelas berhasil disimpan');
    }

    public function updateKelas(Request $request, $id){

        $data = Kelas::find($id);
        $data->nama_kelas = $request->nama_kelas;
        $data->id_guru = $request->id_guru;
        $data->update();
        return redirect('/data-kelas')->with('success', 'kelas berhasil diubah');;
    }

    public function deleteKelas($id){
        $data = Kelas::find($id);
        $data->delete();
        return redirect('/data-kelas')->with('success', 'Data berhasil dihapus');;
    }
// Tahun Jaran
    public function dataTahun(Request $request){

        $kataKunci = $request->input('q');

        $data = TahunAjaran::when($kataKunci, function ($query) use ($kataKunci) {
            $query->where('tahun', 'LIKE', "%$kataKunci%")
                ->orWhere('kelas', 'LIKE', "%$kataKunci%");
        }) ->get();
        return view('admin.data-tahun', ['data' => $data, 'kataKunci' => $kataKunci]);
    }

    public function cariTahun(Request $request)
    {
        // Redirect ke route data-mapel dengan parameter pencarian
        return redirect()->route('data-tahun', ['q' => $request->input('q')]);
    }

    public function tambahTahun(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            'tahun'=> 'required',
        ], $message);
        
        $data = new TahunAjaran;
        $data->tahun = $request->tahun;
        $data->save($attributes);
        return redirect('/data-tahun')->with('success', 'Tahun berhasil disimpan');
    }

    public function updateTahun(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'tahun'=> 'required',
        ], $message);

        $data = TahunAjaran::find($id);
        $data->tahun = $request->tahun;
        $data->update();
        return redirect('/data-tahun')->with('success', 'Tahun berhasil diubah');;
    }

    public function deleteTahun($id){
        $data = TahunAjaran::find($id);
        $data->delete();
        return redirect('/data-tahun')->with('success', 'Tahun berhasil dihapus');;
    }

// peserta didik

    
    public function dataPeserta()
    {
        // Menggunakan metode join untuk menggabungkan tabel PesertaDidik dengan tahun_ajaran dan angkatan berdasarkan id
        $data = PesertaDidik::join('kelas', 'peserta_didik.id_kelas', '=', 'kelas.id')
                            ->join('angkatan', 'peserta_didik.id_angkatan', '=', 'angkatan.id')
                            ->select('peserta_didik.*', 'kelas.nama_kelas', 'angkatan.angkatan')
                            ->get();
        $data1 = Kelas::all();
        $data2 = Angkatan::all();

        return view('admin.data-peserta-admin', ['data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }

    public function cariPeserta(Request $request)
    {
        $kataKunci = $request->input('q');
        $hasilPencarian = PesertaDidik::when($kataKunci, function ($query) use ($kataKunci) {
            $query->where('nisn', 'LIKE', "%$kataKunci%")
            ->orWhere('nama_peserta', 'LIKE', "%$kataKunci%");
        })->paginate(5);

        $data1 = TahunAjaran::all();
        $data2 = Angkatan::all();

        return view('admin.data-peserta-admin', ['data' => $hasilPencarian, 'kataKunci' => $kataKunci,'data1' => $data1, 'data2' => $data2]);
    }

    public function tambahPeserta(Request $request)
    {
        // Validasi form
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
        ];
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'max:20', 'unique:peserta_didik,email'],
            'nisn' => ['required', 'max:30', 'unique:peserta_didik,nisn'],
            'nama_peserta' => 'required',
            'alamat_peserta' => 'required',
            'ttl_peserta' => 'required',
            'no_hp_peserta' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'foto' => 'required|mimes:jpeg,png,pdf|max:2048',
            'status' => 'required',
        ], $message);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('gagal_peserta', 'Validasi gagal, periksa kembali inputan anda.');
        }

        // Simpan data peserta didik
        $data = new PesertaDidik;
        $data->nisn = $request->nisn;
        $data->email = $request->email;
        $data->id_kelas = $request->id_kelas;
        $data->id_angkatan = $request->id_angkatan;
        $data->nama_peserta = $request->nama_peserta;
        $data->alamat_peserta = $request->alamat_peserta;
        $data->ttl_peserta = $request->ttl_peserta;
        $data->no_hp_peserta = $request->no_hp_peserta;
        $data->nama_ayah = $request->nama_ayah;
        $data->nama_ibu = $request->nama_ibu;
        $data->status = $request->status;

        if ($request->hasFile('foto')) {
            $cvFile = $request->file('foto');
            $cvFileName = $cvFile->getClientOriginalName();
            $cvFile->storeAs('public/foto', $cvFileName);
            $data->foto = 'storage/foto/' . $cvFileName;
        }

        $data->save();

        return redirect('data-peserta-admin')->with('success', 'Peserta berhasil disimpan');
    }
    


    public function deletePeserta($id){
        $data = PesertaDidik::find($id);
        $data->delete();
        return redirect('data-peserta-admin')->with('success', 'Peserta berhasil dihapus');;
    }

    public function updatePeserta(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'nama_peserta'=> 'required',
            'alamat_peserta' => 'required',
            'ttl_peserta' => 'required',
            'no_hp_peserta' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'status' => 'required',
        ], $message);

        $data = PesertaDidik::find($id);
        $data->nisn = $request->nisn;
        $data->id_kelas = $request->id_kelas;
        $data->id_angkatan = $request->id_angkatan;
        $data->nama_peserta = $request->nama_peserta;
        $data->alamat_peserta = $request->alamat_peserta;
        $data->ttl_peserta = $request->ttl_peserta;
        $data->no_hp_peserta = $request->no_hp_peserta;
        $data->nama_ayah = $request->nama_ayah;
        $data->nama_ibu = $request->nama_ibu;
        $data->status = $request->status;
        $data->update();
        return redirect('data-peserta-admin')->with('success', 'Peserta berhasil diubah');;
    }


// mapel

    public function dataMapel(Request $request)
    {
        $kataKunci = $request->input('q');
        $data = Mapel::join('kelas', 'mata_pelajaran.id_kelas', '=', 'kelas.id')
                    ->join('angkatan', 'mata_pelajaran.id_angkatan', '=', 'angkatan.id')
                    ->select('mata_pelajaran.*', 'kelas.nama_kelas', 'angkatan.angkatan')
                    ->when($kataKunci, function ($query) use ($kataKunci) {
                        $query->where('mata_pelajaran.mapel', 'LIKE', "%$kataKunci%")
                            ->orWhere('mata_pelajaran.kode_mapel', 'LIKE', "%$kataKunci%");
                    })
                    ->get();
        $data1 = Kelas::all();
        $data2 = Angkatan::all();

        return view('admin.data-mapel', ['data' => $data, 'data1' => $data1, 'data2' => $data2, 'kataKunci' => $kataKunci]);
    }

    public function cariMapel(Request $request)
    {
        return redirect()->route('data-mapel', ['q' => $request->input('q')]);
    }

    public function tambahMapel(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'kode mapel sudah digunakan',
        ];

        $attributes = request()->validate([
            'id_kelas'=> 'required',
            'id_angkatan' => 'required',
            'mapel' => 'required',
            'kode_mapel' => ['required', 'max:50', Rule::unique('mata_pelajaran', 'kode_mapel')],
        ], $message);
        
        $data = new Mapel;
        $data->id_kelas = $request->id_kelas;
        $data->id_angkatan = $request->id_angkatan;
        $data->mapel = $request->mapel;
        $data->kode_mapel = $request->kode_mapel;
        $data->save($attributes);
        return redirect('/data-mapel')->with('success', 'Mapel berhasil disimpan');
    }

    public function updateMapel(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'id_kelas'=> 'required',
            'id_angkatan' => 'required',
            'mapel' => 'required',
        ], $message);

        $data = Mapel::find($id);
        $data->id_kelas = $request->id_kelas;
        $data->id_angkatan = $request->id_angkatan;
        $data->mapel = $request->mapel;
        $data->kode_mapel = $request->kode_mapel;
        $data->update();
        return redirect('/data-mapel')->with('success', 'Mapel berhasil diubah');;
    }

    public function deleteMapel($id){
        $data = Mapel::find($id);
        $data->delete();
        return redirect('/data-mapel')->with('success', 'Data berhasil dihapus');;
    }

    
// angkatan
    public function dataAngkatan()
    {
        $data = Angkatan::withCount('pesertaDidik')->get();
        return view('admin.data-angkatan', ['data' => $data]);
    }

    public function pesertaAngkatan($id)
    {
        $angkatan = Angkatan::find($id);

        $peserta = PesertaDidik::where('id_angkatan',$id)
                              ->join('angkatan','peserta_didik.id_angkatan','=','angkatan.id')
                                 ->select('peserta_didik.*','angkatan.angkatan','peserta_didik.id as peserta_id')
                                 ->paginate(5);
                                 
        
        return view('admin.peserta-angkatan', ['angkatan' => $angkatan, 'peserta' => $peserta]);
    }


    public function tambahAngkatan(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            'angkatan' => ['required', 'max:50', Rule::unique('angkatan', 'angkatan')],
        ], $message);
        
        $data = new Angkatan;
        $data->angkatan = $request->angkatan;
        $data->save($attributes);
        return redirect('/data-angkatan')->with('success', 'karyawab berhasil disimpan');
    }

    public function updateAngkatan(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'angkatan' => ['required', 'max:50', Rule::unique('angkatan', 'angkatan')],
        ], $message);

        $data = Angkatan::find($id);
        $data->angkatan = $request->angkatan;
        $data->update();
        return redirect('/data-angkatan')->with('success', 'Pengguna berhasil diubah');;
    }

    public function deleteAngkatan($id){
        $data = Angkatan::find($id);
        $data->delete();
        return redirect('/data-angkatan')->with('success', 'Data berhasil dihapus');;
    }

// jadwal
  public function dataJadwal(Request $request)
{
    $kelas = Kelas::all();
    $data = collect(); // Kosongkan data jadwal saat pertama kali membuka halaman
    $tahun = TahunAjaran::all();
    $mapel = Mapel::all();

    // Ambil id_kelas dan tahun_id dari request
    $id_kelas = $request->id_kelas;
    $tahun_id = $request->tahun_id;

    // Jika ada pencarian id_kelas
    if ($request->has('id_kelas')) {
        $mapel = Mapel::where('id_kelas', $id_kelas)->get();
    }

    if (!empty($id_kelas) && !empty($tahun_id)) {
        $data = Jadwal::join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
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
            ->where('jadwal.id_kelas', $id_kelas)
            ->where('jadwal.id_ta', $tahun_id)
            ->get();
    }

    // Subquery untuk mendapatkan id guru yang sudah ada di tabel jadwal
    $guruIdsInJadwal = Jadwal::pluck('id_guru')->toArray();

    // Mengambil guru yang sesuai dengan $id pada record tabel jadwal untuk tahun ajaran tertentu
    $guruInJadwal = Jadwal::where('id_ta', $tahun_id)->pluck('id_guru')->toArray();

    // Ambil data2 hanya jika ada pencarian
    $data2 = collect();
    if (!empty($id_kelas)) {
        $data2 = Guru::where('status', 'guru_inti')
                    ->join('kelas', 'guru.id', '=', 'kelas.id_guru')
                    ->where('kelas.id', $id_kelas)
                    ->select('guru.id')
                    ->first();
    }

    // Ambil data3 untuk guru piket
    $data3 = Guru::where('status', 'guru_piket')->get();

    return view('admin.data-jadwal', compact('data', 'kelas', 'tahun', 'mapel', 'data2', 'data3'));
}



    public function cariJadwal(Request $request)
    {
        return redirect()->route('jadwal-admin', [
            'tahun_id' => $request->tahun_id,
            'id_kelas' => $request->id_kelas,
        ]);
    }


    // public function detailJadwal($id)
    // {
    //     // Mengambil data pesanan berdasarkan ID
    //     $Kelas = Kelas::find($id);
    //     $tahun = TahunAjaran::all();

    //     $tahun_id = $request->tahun_id;
    
    //     if ($request->has('id_kelas')&& $request->has('tahun_id')) {
        
    //     $data = Jadwal::join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
    //         ->join('guru AS guru_inti', 'jadwal.id_guru', '=', 'guru_inti.id')
    //         ->leftJoin('guru AS guru_piket', function ($join) {
    //             $join->on('jadwal.id_guruPiket', '=', 'guru_piket.id')
    //                 ->where('jadwal.id_guruPiket', '!=', 0);
    //         })
    //         ->leftJoin('mata_pelajaran AS mapel1', function ($join) {
    //             $join->on('jadwal.id_mapel', '=', 'mapel1.id')
    //                 ->where('jadwal.id_mapel', '!=', 0);
    //         })
    //         ->leftJoin('mata_pelajaran AS mapel2', function ($join) {
    //             $join->on('jadwal.id_mapel1', '=', 'mapel2.id')
    //                 ->where('jadwal.id_mapel1', '!=', 0);
    //         })
    //         ->leftJoin('mata_pelajaran AS mapel3', function ($join) {
    //             $join->on('jadwal.id_mapel2', '=', 'mapel3.id')
    //                 ->where('jadwal.id_mapel2', '!=', 0);
    //         })
    //         ->select('jadwal.*',  'guru_inti.nama_guru AS guru_inti', 'guru_piket.nama_guru AS guru_piket', 'mapel1.mapel AS nama_mapel1', 'mapel2.mapel AS nama_mapel2', 'mapel3.mapel AS nama_mapel3')
    //         ->where('jadwal.id_kelas', $id)
    //         ->where('jadwal.id_ta',$tahun_id)
    //         ->get();
    
    //     $data1 = Mapel::where('id_kelas', $id)->get();
    
    //     // Subquery untuk mendapatkan id guru yang sudah ada di tabel jadwal
    //     $guruIdsInJadwal = Jadwal::pluck('id_guru')->toArray();
        
    //     // Mengambil guru yang sesuai dengan $id pada record tabel jadwal untuk tahun ajaran tertentu
    //     $guruInJadwal = Jadwal::where('id_TA', $id)->pluck('id_guru')->toArray();
        
    //     if (!empty($guruInJadwal)) {
    //         // Jika ada guru yang sesuai dengan $id pada tabel jadwal, tampilkan guru tersebut
    //         $data2 = Guru::whereIn('id', $guruInJadwal)->get();
    //     } else {
    //         // Jika tidak ada, tampilkan semua guru yang belum ada pada tabel jadwal
    //         $data2 = Guru::where('status', 'guru inti')
    //                     ->whereNotIn('id', $guruIdsInJadwal)
    //                     ->get();
    //     }
    
    //     $data3 = Guru::where('status', 'guru piket')->get();   
        
    //     }
    
    //     return view('admin.detail-jadwal', compact('data', 'dataKelas', 'data1', 'data2', 'data3', 'tahun','id'));
    // }

    
    public function tambahJadwal(Request $request) {
        // Validasi form
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
        ];
    
        $attributes = $request->validate([
            'id_mapel' => 'required',
            'id_mapel1' => 'required',
            'id_mapel2' => 'required',
            'id_guru' => 'required',
            'id_guruPiket' => 'required',
            'hari' => [
                'required',
                Rule::unique('jadwal')->where(function ($query) use ($request) {
                    return $query->where('id_ta', $request->tahun_id)
                                 ->where('id_kelas', $request->id_kelas)
                                 ->where('hari', $request->hari);
                }),
            ],
        ], $messages);
    
        // Menyimpan data baru
        $data = new Jadwal;
        $data->id_kelas = $request->id_kelas;
        $data->id_ta = $request->tahun_id;
        $data->id_mapel = $request->id_mapel;
        $data->id_mapel1 = $request->id_mapel1;
        $data->id_mapel2 = $request->id_mapel2;
        $data->id_guru = $request->id_guru;
        $data->id_guruPiket = $request->id_guruPiket;
        $data->hari = $request->hari;
        $data->save();
    
        return redirect()->route('jadwal-admin', [
            'id_kelas' => $request->id_kelas,
            'tahun_id' => $request->tahun_id,
        ])->with('success', 'Jadwal berhasil ditambahkan.');
    }
    
    public function getGuruPiketByHari(Request $request)
    {
        $hari = $request->input('hari');
        $tahun_id = $request->input('tahun_id');
        
        // Mengambil ID guru piket yang sudah ada dalam jadwal untuk hari dan tahun tertentu
        $guruIdsInJadwal = Jadwal::where('hari', $hari)
                                ->where('id_ta', $tahun_id)
                                ->pluck('id_guruPiket')
                                ->toArray();
    
        // Mengambil guru piket yang tidak ada dalam jadwal di hari yang sama untuk tahun ajaran tertentu
        $dataGuruPiket = Guru::where('status', 'guru_piket')
                            ->whereNotIn('id', $guruIdsInJadwal)
                            ->get();
    
        return response()->json($dataGuruPiket);
    }
    
    

    public function updateJadwal(Request $request, $id){
        //validasi form
        $message= [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah digunakan',
            'numeric' => ':attribute harus berupa angka',
        ];
    
        $this->validate($request, [
            'id_mapel' => 'required',
            'id_mapel1' => 'required',
            'id_mapel2' => 'required',
            'id_guruPiket' => 'required',
            'hari' => [
                'required',
                Rule::unique('jadwal')->ignore($id)->where(function ($query) use ($request) {
                    return $query->where('id_ta', $request->tahun_id)
                                 ->where('id_kelas', $request->id_kelas)
                                 ->where('hari', $request->hari);
                }),
            ],
        ], $message);
    
        $data = Jadwal::find($id);
        $data->id_mapel = $request->id_mapel;
        $data->id_mapel1 = $request->id_mapel1;
        $data->id_mapel2 = $request->id_mapel2;
        $data->id_guruPiket = $request->id_guruPiket;
        $data->hari = $request->hari;
        $data->update();
    
        return back()->with('success', 'Jadwal berhasil diubah');
    }

    
    public function deleteJadwal($id){
        $data = Jadwal::find($id);
        $data->delete();
        return back()->with('success', 'Jadwal berhasil dihapus');
    }

// Kegiatan
    public function dataKegiatan(){
        $data = Kegiatan::paginate(5);
        return view('admin.data-kegiatan', ['data' => $data]);
    }

    public function tambahKegiatan(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'keterangan' => 'required',
        ], $message);
        
        $data = new Kegiatan;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->tgl_kegiatan = $request->tgl_kegiatan;
        $data->keterangan = $request->keterangan;
        $data->save($attributes);
        return redirect('kegiatan')->with('success', 'karyawab berhasil disimpan');
    }

    public function updateKegiatan(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'keterangan' => 'required',
        ], $message);

        $data = Kegiatan::find($id);
        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->tgl_kegiatan = $request->tgl_kegiatan;
        $data->keterangan = $request->keterangan;
        $data->update();
        return redirect('kegiatan')->with('success', 'Pengguna berhasil diubah');;
    }

    public function deleteKegiatan($id){
        $data = Kegiatan::find($id);
        $data->delete();
        return redirect('kegiatan')->with('success', 'Data berhasil dihapus');;
    }

// catatan ngaji
    public function dataCatatan(){
        $data = Catatan::all();
        return view('admin.data-catatan', ['data' => $data]);
    }

// rekap absen

    public function rekapAbsen(Request $request)
    {
        $tahun = TahunAjaran::all(); // Kosongkan data siswa saat pertama kali membuka halaman
        $kelas = Kelas::all();
        $id_kelas = $request->id_kelas;
        $semester = $request->semester;
        $tahun_id = $request->tahun_id;

        $query = PesertaDidik::join('kelas', 'peserta_didik.id_kelas', '=', 'kelas.id')
            ->join('angkatan', 'peserta_didik.id_angkatan', '=', 'angkatan.id')
            ->leftJoin('absen', 'peserta_didik.id', '=', 'absen.id_peserta')
            ->select(
                'peserta_didik.id', 
                'peserta_didik.nisn', 
                'peserta_didik.nama_peserta', 
                'kelas.nama_kelas', 
                'angkatan.angkatan',
                \DB::raw('COALESCE(SUM(CASE WHEN absen.status = "izin" THEN 1 ELSE 0 END), 0) as izin'),
                \DB::raw('COALESCE(SUM(CASE WHEN absen.status = "alfa" THEN 1 ELSE 0 END), 0) as alfa'),
                \DB::raw('COALESCE(SUM(CASE WHEN absen.status = "sakit" THEN 1 ELSE 0 END), 0) as sakit')
            );

        if ($request->has('id_kelas') && $request->has('semester') && $request->has('tahun_id')) {
            $query->where('peserta_didik.id_kelas', $id_kelas)
                ->where('absen.semester', $semester)
                ->where('absen.tahun_id', $tahun_id);
        }

        $data = $query->groupBy(
            'peserta_didik.id', 
            'peserta_didik.nisn', 
            'peserta_didik.nama_peserta', 
            'kelas.nama_kelas', 
            'angkatan.angkatan'
        )->get();

        return view('admin.rekap-absen', compact('data', 'tahun','kelas'));
    }

    

    public function searchRekapAbsen(Request $request)
    {
        return redirect()->route('rekap-absen', [
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
            'id_kelas' => $request->id_kelas,
        ]);
    }


// wali murid akun
    public function akunWaliMurid()
    {
        // Get students who do not have a profile
        $data = PesertaDidik::leftJoin('profile', 'peserta_didik.nisn', '=', 'profile.nisn')
                    ->whereNull('profile.nisn')
                    ->select('peserta_didik.*')
                    ->get();
        
        return view('admin.akun-waliMurid', ['data' => $data]);
    }

    public function buatAkunWali(Request $request)
    {
        $NISNs = explode(',', $request->nisn);
        $emails = explode(',', $request->email);
    
        foreach ($NISNs as $index => $nisn) {
            $email = $emails[$index];
    
            request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            ]);
    
            $password = Str::random(8);
    
            $data1 = new User;
            $data1->name = $nisn;
            $data1->email = $email;
            $data1->password = bcrypt($password);
            $data1->level = "waliMurid";
            $data1->save();
    
            $data = new Profile;
            $data->id_user = $data1->id;
            $data->nisn = $nisn;
            $data->save();
    
            // Kirim email ke wali murid
            Mail::to($email)->send(new AkunWaliMail($nisn, $email, $password));
        }
    
        return redirect('/akun-waliMurid')->with('success', 'Akun berhasil dibuat dan email telah dikirim.');
    } 
}
