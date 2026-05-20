<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\PengumumanController;

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileMhsController;
use App\Http\Controllers\KrsController;

// ✅ HALAMAN PILIH LOGIN
Route::get('/login', function () {
    return view('auth.login_select');
})->name('login');

// ✅ SEMUA LOGIN MASUK SINI
Route::middleware('guest')->group(function () {
    Route::get('/login/admin', [AuthController::class, 'showLogin']);
    Route::post('/login/admin', [AuthController::class, 'login'])->name('login.admin.post');

    Route::get('/login/mhs', function () {
        return view('auth.login_mhs');
    });
    Route::post('/login/mhs', [AuthController::class, 'loginMhs'])->name('login.mhs');
});

Route::get('/login/dosen', function () {
    return view('auth.login_dosen');
});
Route::post('/login/dosen', [AuthController::class, 'loginDosen'])->name('login.dosen');

// ✅ AREA MAHASISWA
Route::middleware('auth')->prefix('mhs')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mhs.dashboard');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('mhs.feedback');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('mhs.feedback.store');
    Route::get('/feedback/delete/{id}', [FeedbackController::class, 'delete'])->name('mhs.feedback.delete');
    Route::get('/feedback/edit/{id}', [FeedbackController::class, 'edit'])->name('mhs.feedback.edit');
    Route::post('/feedback/update/{id}', [FeedbackController::class, 'update'])->name('mhs.feedback.update');

    Route::get('/matkul', [MatkulController::class, 'mkr'])->name('mhs.matkul');
    Route::post('/matkul', [MatkulController::class, 'storeMkr'])->name('mhs.matkul.store');

    Route::get('/mku', [MatkulController::class, 'mku'])->name('mhs.mku');
    Route::post('/mku', [MatkulController::class, 'storeMku'])->name('mhs.mku.store');

    Route::get('/profile', [ProfileMhsController::class, 'index'])->name('mhs.profile');
    Route::post('/profile', [ProfileMhsController::class, 'update'])->name('mhs.profile.update');

    Route::get('/krs', [KrsController::class, 'index'])->name('mhs.krs');
    Route::delete('/krs/{id}', [KrsController::class, 'destroy'])->name('mhs.krs.delete');
});

// ✅ AREA DOSEN
Route::middleware('auth')->prefix('dosen')->group(function () {
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('/profile', [DosenController::class, 'profile'])->name('dosen.profile');
    Route::post('/profile', [DosenController::class, 'update'])->name('dosen.profile.update');
    Route::get('/feedback', [DosenController::class, 'feedback'])->name('dosen.feedback');
    Route::get('/feedback/detail/{npm}', [DosenController::class, 'detailFeedback'])->name('dosen.feedback.detail');
    Route::get('/approve-krs', [DosenController::class, 'approveKrs'])->name('dosen.approve');
    Route::get('/approve-krs/{npm}', [DosenController::class, 'detailKrs'])->name('dosen.approve.detail');
    Route::post('/krs/setujui/{id}', [DosenController::class, 'setujuiKrs'])->name('dosen.krs.setujui');
    Route::post('/krs/tolak/{id}', [DosenController::class, 'tolakKrs'])->name('dosen.krs.tolak');
    Route::post('/krs/reset/{id}', [DosenController::class, 'resetKrs'])->name('dosen.krs.reset');
});

// ✅ AREA ADMIN
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
    Route::get('/matkul/create', [MatkulController::class, 'create'])->name('matkul.create');
    Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/matkul/{id}/edit', [MatkulController::class, 'edit'])->name('matkul.edit');
    Route::put('/matkul/{id}', [MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('/matkul/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');
    Route::resource('pengumuman', PengumumanController::class);
});

// ✅ LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ✅ ROOT
Route::get('/', function () {
    return redirect('/login');
});