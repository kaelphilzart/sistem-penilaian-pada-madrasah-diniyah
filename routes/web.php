<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepalaMadrasahController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\WaliMuridController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('login', [SessionController::class, 'login'])-> name('login');
Route::get('/register', [SessionController::class, 'register'])-> name('register');
Route::post('buat-akun', [SessionController::class, 'createUser'])-> name('buat-akun');
Route::post('login-akun', [SessionController::class, 'login_akun'])->name('login-akun');

Route::middleware(['auth'])->group(function () {
    // Rute untuk pengguna dengan tingkat 'admin'


    Route::middleware(['admin'])->group(function () {

        Route::get('dashboard_admin', [AdminController::class, 'dashboard'])-> name('dashboard_admin');
        Route::get('logout-admin', [SessionController::class, 'destroyAdmin'])->name('logout-admin');
        Route::get('data-user', [AdminController::class, 'dataUser'])-> name('data-user');
        Route::get('/user/cari', [AdminController::class, 'cariUser'])->name('user-cari');
        Route::post('create-user', [AdminController::class, 'createUser'])-> name('create-user');
        Route::post('/user/update/{id}', [AdminController::class, 'updateUser']) -> name('update-user');
        Route::post('/user/delete/{id}', [AdminController::class, 'deleteUser']) -> name('delete-user');

//Guru
        Route::get('data-guru', [AdminController::class, 'dataGuru'])-> name('data-guru');
        Route::post('tambah-guru', [AdminController::class, 'tambahGuru'])-> name('tambah-guru');
        Route::post('/guru/update/{id}', [AdminController::class, 'updateGuru']) -> name('update-guru');
        Route::post('/guru/delete/{id}', [AdminController::class, 'deleteGuru']) -> name('delete-guru');
        Route::get('/guru/cari', [AdminController::class, 'cariGuru'])->name('guru-cari');

// Tahun Ajaran
        Route::get('data-tahun', [AdminController::class, 'dataTahun'])-> name('data-tahun');
        Route::post('tambah-tahun', [AdminController::class, 'tambahTahun'])-> name('tambah-tahun');
        Route::post('/tahun/update/{id}', [AdminController::class, 'updateTahun']) -> name('update-tahun');
        Route::post('/tahun/delete/{id}', [AdminController::class, 'deleteTahun']) -> name('delete-tahun');
        Route::get('/tahun/cari', [AdminController::class, 'cariTahun'])->name('tahun-cari');

// Kelas
        Route::get('data-kelas', [AdminController::class, 'dataKelas'])-> name('data-kelas');
        Route::post('tambah-kelas', [AdminController::class, 'tambahKelas'])-> name('tambah-kelas');
        Route::post('/kelas/update/{id}', [AdminController::class, 'updateKelas']) -> name('update-kelas');
        Route::post('/kelas/delete/{id}', [AdminController::class, 'deleteKelas']) -> name('delete-kelas');

// peserta didik
        Route::get('/data-peserta-admin', [AdminController::class, 'dataPeserta'])->name('data-peserta-admin');
        Route::post('tambah-peserta', [AdminController::class, 'tambahPeserta'])-> name('tambah-peserta');
        Route::post('/peserta/delete/{id}', [AdminController::class, 'deletePeserta']) -> name('delete-peserta');
        Route::post('/peserta/update/{id}', [AdminController::class, 'updatePeserta']) -> name('update-peserta');
        Route::get('/peserta/cari', [AdminController::class, 'cariPeserta'])->name('peserta-cari');

// mapel
        Route::get('data-mapel', [AdminController::class, 'dataMapel'])-> name('data-mapel');
        Route::post('tambah-mapel', [AdminController::class, 'tambahMapel'])-> name('tambah-mapel');
        Route::post('/mapel/delete/{id}', [AdminController::class, 'deleteMapel']) -> name('delete-mapel');
        Route::post('/mapel/update/{id_mapel}', [AdminController::class, 'updateMapel']) -> name('update-mapel');
        Route::get('/mapel/cari', [AdminController::class, 'cariMapel'])->name('mapel-cari');
    
// angkatan
        Route::get('data-angkatan', [AdminController::class, 'dataAngkatan'])-> name('data-angkatan');
        Route::post('tambah-angkatan', [AdminController::class, 'tambahAngkatan'])-> name('tambah-angkatan');
        Route::post('/angkatan/delete/{id}', [AdminController::class, 'deleteAngkatan']) -> name('delete-angkatan');
        Route::post('/angkatan/update/{id_angkatan}', [AdminController::class, 'updateAngkatan']) -> name('update-angkatan');

        Route::get('/peserta/angkatan/{id}', [AdminController::class, 'pesertaAngkatan']) -> name('peserta-angkatan');

// jadwal
        Route::get('jadwal-admin', [AdminController::class, 'dataJadwal'])-> name('jadwal-admin');
        Route::get('/jadwal/detail/{id}', [AdminController::class, 'detailJadwal']) -> name('detail-jadwal');
        Route::post('tambah-jadwal-admin', [AdminController::class, 'tambahJadwal'])-> name('tambah-jadwal-admin');
        Route::post('/jadwal/delete/{id}', [AdminController::class, 'deleteJadwal']) -> name('delete-jadwal');
        Route::post('/jadwal/update/{id}', [AdminController::class, 'updateJadwal']) -> name('update-jadwal');
        Route::post('/admin/guru-piket-by-hari', [AdminController::class, 'getGuruPiketByHari']);
        Route::get('/cari-jadwal-admin', [AdminController::class, 'cariJadwal'])->name('cari-jadwal-admin');
        

// kegiatan
        Route::get('kegiatan', [AdminController::class, 'dataKegiatan'])-> name('kegiatan');
        Route::post('tambah-kegiatan', [AdminController::class, 'tambahKegiatan'])-> name('tambah-kegiatan');
        Route::post('/kegiatan/delete/{id}', [AdminController::class, 'deleteKegiatan']) -> name('delete-kegiatan');
        Route::post('/kegiatan/update/{id}', [AdminController::class, 'updateKegiatan']) -> name('update-kegiatan');
        Route::get('/load-kegiatan', [AdminController::class, 'loadKegiatan'])->name('load-kegiatan');


// catatan
        Route::get('data-catatan', [AdminController::class, 'dataCatatan'])-> name('data-catatan');

// rekap absen
        Route::get('rekap-absen', [AdminController::class, 'rekapAbsen'])->name('rekap-absen');
        Route::get('/cari-rekap-absen', [AdminController::class, 'searchRekapAbsen'])->name('cari-rekap-absen');

//buat akun wali murid
        Route::get('akun-waliMurid', [AdminController::class, 'akunWaliMurid'])-> name('akun-waliMurid');
        Route::post('buat-akun-wali', [AdminController::class, 'buatAkunWali'])-> name('buat-akun-wali');

    });

    Route::middleware(['kepalaMadrasah'])->group(function () {
       
        Route::get('dashboard_kepalaMadrasah', [KepalaMadrasahController::class, 'dashboard'])-> name('dashboard_kepalaMadrasah');
        Route::get('logout-kepalaMadrasah', [SessionController::class, 'destroyKepalaMadrasah'])->name('logout-kepalaMadrasah');
        Route::get('/load-kegiatan-kepala', [KepalaMadrasahController::class, 'loadKegiatan'])->name('load-kegiatan-kepala');

        Route::get('data-guru-kepala', [KepalaMadrasahController::class, 'dataGuru'])->name('data-guru-kepala');
        Route::get('/filter-guru', [KepalaMadrasahController::class, 'filterGuru'])->name('filter-guru');
        Route::get('tahun-mapel', [KepalaMadrasahController::class, 'tahunMapel'])->name('tahun-mapel');
        Route::get('/mapel/{id}', [KepalaMadrasahController::class, 'mapel']) -> name('mapel');
        
        Route::get('data-peserta-kepala', [KepalaMadrasahController::class, 'dataPeserta'])->name('data-peserta-kepala');
        Route::get('/filter-peserta', [KepalaMadrasahController::class, 'filterPeserta'])->name('filter-peserta');
        // Route::get('/peserta/{id}', [KepalaMadrasahController::class, 'peserta']) -> name('peserta');
      
    });

    Route::middleware(['guru'])->group(function () {

        Route::middleware(['checkGuru:guru_inti'])->group(function () {
                Route::get('dashboard_guru_inti', [GuruController::class, 'dashboard'])-> name('dashboard_guru_inti');
                Route::get('logout-guru', [SessionController::class, 'destroyGuru'])->name('logout-guru');
        
                // Route::get('data-siswa', [GuruController::class, 'dataSiswa'])-> name('data-siswa');
        // jadwal
                Route::get('data-jadwal', [GuruController::class, 'dataJadwal']) -> name('data-jadwal');
                Route::get('/cari-jadwal', [GuruController::class, 'searchJadwal'])->name('cari-jadwal');
        
        // absen
                
                Route::get('data-absen', [GuruController::class, 'dataAbsen']) -> name('data-absen');
                Route::get('/cari-absen', [GuruController::class, 'searchAbsen'])->name('cari-absen');
                Route::post('input-absen', [GuruController::class, 'inputAbsen'])-> name('input-absen');
                Route::post('/absen/update/{id}', [GuruController::class, 'updateAbsen']) -> name('update-absen');
                Route::get('/setelah-absen', [GuruController::class, 'setelahAbsen'])->name('setelah-absen');
        
        //peserta didik
                Route::get('data-peserta', [GuruController::class, 'dataPeserta'])->name('data-peserta');
                Route::get('/cari-peserta', [GuruController::class, 'searchPeserta'])->name('cari-peserta');
        
        // nilai
                Route::get('nilai', [GuruController::class, 'nilai'])->name('nilai');
                Route::get('/cari-nilai', [GuruController::class, 'searchNilai'])->name('cari-nilai');
                Route::get('/data/nilai/{nisn}/{id_kelas}/{tahun_id}/{semester}', [GuruController::class, 'dataNilai']) -> name('data-nilai');
                Route::post('input-nilai', [GuruController::class, 'inputNilai'])-> name('input-nilai');
                Route::post('/nilai/update/{id}', [GuruController::class, 'updateNilai']) -> name('update-nilai');
                Route::get('/filter-mapel', [GuruController::class, 'filterMapel'])->name('filter-mapel');
        
                Route::post('import-nilai', [GuruController::class, 'importNilai'])-> name('import-nilai');
        
        //rekap
                Route::get('rekap-nilai', [GuruController::class, 'rekapNilai'])->name('rekap-nilai');
                Route::get('/cari-rekap-nilai', [GuruController::class, 'searchRekapNilai'])->name('cari-rekap-nilai');
                Route::get('/lihat/rekap/{id_peserta}/{id_tahun}', [GuruController::class, 'lihatRekap']) -> name('lihat-rekap');
        
        //catatan
                Route::get('catatan-ngaji-guru', [GuruController::class, 'catatanNgaji'])->name('catatan-ngaji-guru');
                Route::get('/cari-catatan-ngaji', [GuruController::class, 'searchCatatanNgaji'])->name('cari-catatan-ngaji');
                Route::get('/lihat/catatan/{nisn}/{id_kelas}/{tahun_id}/{semester}', [GuruController::class, 'lihatCatatan']) -> name('lihat-catatan');
                Route::post('tambah-catatan', [GuruController::class, 'tambahCatatan']) -> name('tambah-catatan');
                Route::post('/catatan/update/{id}', [GuruController::class, 'updateCatatan']) -> name('update-catatan');
        
        //kegiatan
                Route::get('data-kegiatan', [GuruController::class, 'dataKegiatan'])->name('data-kegiatan');
                Route::get('/load-kegiatan-guru', [GuruController::class, 'loadKegiatanGuru'])->name('load-kegiatan-guru');
        
                //cetak raport
                Route::get('/lihat-raport/{nisn}/{id_kelas}/{tahun_id}/{semester}', [GuruController::class, 'lihatRaport'])->name('lihat-raport');
        });

        Route::middleware(['checkGuru:guru_piket'])->group(function () {
                Route::get('dashboard_guru_piket', [GuruPiketController::class, 'dashboard'])-> name('dashboard_guru_piket');
                Route::get('logout-guru-piket', [SessionController::class, 'destroyGuru'])->name('logout-guru-piket');
                Route::get('/load-kegiatan-guru-piket', [GuruPiketController::class, 'loadKegiatanGuruPiket'])->name('load-kegiatan-guru-piket');

                // absen
                Route::get('data-absen-peserta', [GuruPiketController::class, 'dataAbsen']) -> name('data-absen-peserta');
                Route::get('/cari-absen-peserta', [GuruPiketController::class, 'searchAbsen'])->name('cari-absen-peserta');
                Route::post('input-absen-peserta', [GuruPiketController::class, 'inputAbsen'])-> name('input-absen-peserta');
                Route::post('/absen-peserta/update/{id}', [GuruPiketController::class, 'updateAbsen']) -> name('update-absen-peserta');
                Route::get('/setelah-absen-peserta', [GuruPiketController::class, 'setelahAbsen'])->name('setelah-absen-peserta');
                Route::get('/get-mapel/{id_kelas}', [GuruPiketController::class, 'getMapelKelas']);

                //catatan ngaji
                Route::get('catatan-ngaji-guru-piket', [GuruPiketController::class, 'catatanNgaji'])->name('catatan-ngaji-guru-piket');
                Route::get('/cari-catatan-ngaji-guru-piket', [GuruPiketController::class, 'searchCatatanNgaji'])->name('cari-catatan-ngaji-guru-piket');
                Route::get('/lihat/catatan-ngaji/{nisn}/{id_kelas}/{tahun_id}/{semester}', [GuruPiketController::class, 'lihatCatatan']) -> name('lihat-catatan-ngaji');
                Route::post('tambah-catatan-ngaji', [GuruPiketController::class, 'tambahCatatan']) -> name('tambah-catatan-ngaji');
                Route::post('/catatan-ngaji/update/{id}', [GuruPiketController::class, 'updateCatatan']) -> name('update-catatan-ngaji');

                // jadwal
                Route::get('data-jadwal-piket', [GuruPiketController::class, 'dataJadwal']) -> name('data-jadwal-piket');
                Route::get('/cari-jadwal-piket', [GuruPiketController::class, 'searchJadwal'])->name('cari-jadwal-piket');
                
        });
    
 
      
    });

    Route::middleware(['waliMurid'])->group(function () {
    
        Route::get('dashboard_waliMurid', [WaliMuridController::class, 'dashboard'])-> name('dashboard_waliMurid');
        Route::get('logout-waliMurid', [SessionController::class, 'destroyWaliMurid'])->name('logout-waliMurid');
        Route::get('/load-kegiatan-waliMurid', [WaliMuridController::class, 'loadKegiatan'])->name('load-kegiatan-waliMurid');

        Route::get('isi-profile', [WaliMuridController::class, 'isiProfile'])->name('isi-profile');
        Route::get('profile', [WaliMuridController::class, 'profile'])->name('profile');
        Route::post('input-profile', [WaliMuridController::class, 'inputProfile']) -> name('input-profile');
        Route::get('jadwal', [WaliMuridController::class, 'jadwal'])->name('jadwal');
        Route::get('catatan-ngaji', [WaliMuridController::class, 'catatanNgaji'])->name('catatan-ngaji');

        Route::get('pengaturan-akun', [WaliMuridController::class, 'pengaturanAkun'])->name('pengaturan-akun');
        Route::post('ubah-user', [WaliMuridController::class, 'ubahUser']) -> name('ubah-user');
        Route::get('raport-waliMurid', [WaliMuridController::class, 'raport'])->name('raport-waliMurid');
        Route::get('/show-raport/{nisn}/{id_kelas}/{tahun_id}/{semester}', [WaliMuridController::class, 'showRaport']) -> name('show-raport');
        
      
      
    });
    
});