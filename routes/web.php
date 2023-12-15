<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\PemainController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect('/beranda');
});

Route::get('/beranda', [DashboardController::class, 'index']);

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/detail/{id}', [BeritaController::class, 'indexDetail']);

Route::get('/galeri', [GaleriController::class, 'index']);

Route::get('/profil', [ProfilController::class, 'index']);
Route::post('/profil/pemain/edit/{id}', [ProfilController::class, 'editPemain']);
Route::post('/profil/pelatih/edit/{id}', [ProfilController::class, 'editPelatih']);

Route::post('/profil/edit/username/{id}', [UserController::class, 'editUsername']);
Route::post('/profil/edit/password/{id}', [UserController::class, 'editPassword']);
Route::post('/profil/edit/foto_profil/{id}', [UserController::class, 'editFotoProfil']);

Route::prefix('/')->middleware('auth')->group(function () {

    Route::middleware(['auth'])->group(function () {

        /* ---------------------------- Route Untuk Admin --------------------------- */
        Route::middleware(['isAdmin'])->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'indexDashboard']);

            Route::get("/log", [LogsController::class, 'index']);

            /* ------------------------------- Route admin ------------------------------ */
            Route::get('admin', [AdminController::class, 'index']);
            Route::get('/admin/tambah', [AdminController::class, 'indexCreate']);
            Route::post('/admin/tambah', [AdminController::class, 'create']);
            Route::post('/admin/edit/{id}', [AdminController::class, 'edit']);
            Route::delete('/admin/hapus/{id}', [AdminController::class, 'delete']);

            /* ------------------------------ Route pelatih ----------------------------- */
            Route::get('/pelatih/tambah', [PelatihController::class, 'indexCreate']);
            Route::post('/pelatih/tambah', [PelatihController::class, 'create']);
            Route::post('/pelatih/edit/{id}', [PelatihController::class, 'edit']);
            Route::delete('/pelatih/hapus/{id}', [PelatihController::class, 'delete']);

            /* ------------------------------ Route Pemain ------------------------------ */
            Route::get('/pemain/tambah', [PemainController::class, 'indexCreate']);
            Route::post('/pemain/tambah', [PemainController::class, 'create']);
            Route::post('/pemain/edit/{id}', [PemainController::class, 'edit']);
            Route::delete('/pemain/hapus/{id}', [PemainController::class, 'delete']);

            /* ------------------------------ Route Galeri ------------------------------ */
            Route::get("/galeri/tambah", [GaleriController::class, 'indexCreate']);
            Route::post("/galeri/tambah", [GaleriController::class, 'create']);
            Route::post('/galeri/edit/{id}', [GaleriController::class, 'edit']);
            Route::delete("/galeri/hapus/{id}", [GaleriController::class, 'delete']);

            /* ------------------------------ Route Berita ------------------------------ */
            Route::get("/berita/tambah", [BeritaController::class, 'indexCreate']);
            Route::post('/berita/tambah', [BeritaController::class, 'create']);
            Route::post('/berita/edit/{id}', [BeritaController::class, 'edit']);
            Route::delete("/berita/hapus/{id}", [BeritaController::class, 'delete']);
        });

        Route::middleware(['isPelatihOrAdmin'])->group(function () {
            /* -------------------------------- Route Tim ------------------------------- */
            Route::get('/tim/tambah', [TimController::class, 'indexCreate']);
            Route::post('/tim/tambah', [TimController::class, 'create']);
            Route::post('/tim/edit/{id}', [TimController::class, 'edit']);
            Route::delete('/tim/hapus/{id}', [TimController::class, 'delete']);

            /* ---------------------------- Route Anggota Tim --------------------------- */
            Route::post('/tim/tambah/anggota', [TimController::class, 'createAnggota']);
            Route::delete('/tim/hapus/anggota/{id}', [TimController::class, 'deleteAnggota']);

            /* ------------------------------ Route Jadwal ------------------------------ */
            Route::get('/jadwal/tambah', [JadwalController::class, 'indexCreate']);
            Route::post('/jadwal/tambah', [JadwalController::class, 'create']);
            Route::post('/jadwal/edit/{id}', [JadwalController::class, 'edit']);
            Route::delete('/jadwal/hapus/{id}', [JadwalController::class, 'delete']);

            /* ----------------------------- Route Kegiatan ----------------------------- */
            Route::get('/jadwal/{id}/kegiatan/tambah', [KegiatanController::class, 'indexCreate']);
            Route::post('/jadwal/{id}/kegiatan/tambah/', [KegiatanController::class, 'create']);
            Route::post('/jadwal/kegiatan/edit/{id}', [KegiatanController::class, 'edit']);
            Route::delete('/jadwal/kegiatan/hapus/{id}', [KegiatanController::class, 'delete']);

            Route::post('/jadwal/kegiatan/tambah/laporan-kegiatan', [KegiatanController::class, 'createLaporan']);
        });
    });


    Route::get('/pelatih', [PelatihController::class, 'index']);
    Route::get('/pelatih/detail/{id}', [PelatihController::class, 'indexDetail']);
    // Route::get('/pelatih/cetak/', [PelatihController::class, 'print']);
    Route::get('/pelatih/cetak/', [PelatihController::class, 'cetakPelatih']);

    Route::get('/pemain', [PemainController::class, 'index']);
    Route::get('/pemain/detail/{id}', [PemainController::class, 'indexDetail']);
    Route::get('/pemain/cetak/', [PemainController::class, 'cetakPemain']);

    Route::get('/tim', [TimController::class, 'index']);
    Route::get('/tim/detail/{id}', [TimController::class, 'indexDetail']);
    Route::post('/tim/edit/{id}', [TimController::class, 'edit']);

    Route::post('/tim/tambah/anggota', [TimController::class, 'createAnggota']);
    Route::delete('/tim/hapus/anggota/{id}', [TimController::class, 'deleteAnggota']);


    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::get('/jadwal/cetak/', [JadwalController::class, 'cetakJadwal']);

    Route::get('/jadwal/kegiatan/{id}', [KegiatanController::class, 'index']);
    Route::get('/jadwal/kegiatan/detail/{id}', [KegiatanController::class, 'indexDetail']);
});
