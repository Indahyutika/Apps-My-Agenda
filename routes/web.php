<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyAgendaUserController;
use App\Http\Controllers\MyAgendaSekolahController;
use App\Http\Controllers\MyAgendaAgendaController;
use App\Http\Controllers\MyAgendaRunningTextController;
use App\Http\Controllers\MyAgendaGambarController;
use App\Http\Controllers\DashboardAdminController; 
use App\Http\Controllers\MyAgendaProfileController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:pengguna'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    });
});

Route::middleware(['role:pengguna'])->group(function () {
    Route::get('myagenda_user', [MyAgendaUserController::class, 'index'])->name('myagenda_user.index');
    Route::get('myagenda_user/create', [MyAgendaUserController::class, 'create'])->name('myagenda_user.create');
    Route::post('myagenda_user', [MyAgendaUserController::class, 'store'])->name('myagenda_user.store');
    Route::get('myagenda_user/{id}/edit', [MyAgendaUserController::class, 'edit'])->name('myagenda_user.edit');
    Route::put('myagenda_user/{id}', [MyAgendaUserController::class, 'update'])->name('myagenda_user.update');
    Route::delete('myagenda_user/{id}', [MyAgendaUserController::class, 'destroy'])->name('myagenda_user.destroy');

    Route::get('myagenda_sekolah', [MyAgendaSekolahController::class, 'index'])->name('myagenda_sekolah.index');
    Route::get('myagenda_sekolah/create', [MyAgendaSekolahController::class, 'create'])->name('myagenda_sekolah.create');
    Route::post('myagenda_sekolah', [MyAgendaSekolahController::class, 'store'])->name('myagenda_sekolah.store');
    Route::get('myagenda_sekolah/{id}/edit', [MyAgendaSekolahController::class, 'edit'])->name('myagenda_sekolah.edit');
    Route::put('myagenda_sekolah/{id}', [MyAgendaSekolahController::class, 'update'])->name('myagenda_sekolah.update');
    Route::delete('myagenda_sekolah/{id}', [MyAgendaSekolahController::class, 'destroy'])->name('myagenda_sekolah.destroy');

    Route::get('/provinsi', [MyAgendaSekolahController::class, 'getProvinsi']);
    Route::get('/kabupaten/{provinsi_id}', [MyAgendaSekolahController::class, 'getKabupatenKota']);
    Route::get('/kecamatan/{kabupaten_id}', [MyAgendaSekolahController::class, 'getKecamatan']);
    Route::get('/kelurahan/{kecamatan_id}', [MyAgendaSekolahController::class, 'getKelurahan']);

    Route::get('myagenda_agenda', [MyAgendaAgendaController::class, 'index'])->name('myagenda_agenda.index');
    Route::get('myagenda_agenda/create', [MyAgendaAgendaController::class, 'create'])->name('myagenda_agenda.create');
    Route::post('myagenda_agenda', [MyAgendaAgendaController::class, 'store'])->name('myagenda_agenda.store');
    Route::get('myagenda_agenda/{id}/edit', [MyAgendaAgendaController::class, 'edit'])->name('myagenda_agenda.edit');
    Route::get('myagenda_agenda/{id}/show', [MyAgendaAgendaController::class, 'show'])->name('myagenda_agenda.show');
    Route::put('myagenda_agenda/{id}', [MyAgendaAgendaController::class, 'update'])->name('myagenda_agenda.update');
    Route::delete('myagenda_agenda/{id}', [MyAgendaAgendaController::class, 'destroy'])->name('myagenda_agenda.destroy');

    Route::get('myagenda_runningtext', [MyAgendaRunningTextController::class, 'index'])->name('myagenda_runningtext.index');
    Route::get('myagenda_runningtext/create', [MyAgendaRunningTextController::class, 'create'])->name('myagenda_runningtext.create');
    Route::post('myagenda_runningtext', [MyAgendaRunningTextController::class, 'store'])->name('myagenda_runningtext.store');
    Route::get('myagenda_runningtext/{id}/edit', [MyAgendaRunningTextController::class, 'edit'])->name('myagenda_runningtext.edit');
    Route::put('myagenda_runningtext/{id}', [MyAgendaRunningTextController::class, 'update'])->name('myagenda_runningtext.update');
    Route::delete('myagenda_runningtext/{id}', [MyAgendaRunningTextController::class, 'destroy'])->name('myagenda_runningtext.destroy');

    Route::get('myagenda_gambar', [MyAgendaGambarController::class, 'index'])->name('myagenda_gambar.index');
    Route::get('myagenda_gambar/create', [MyAgendaGambarController::class, 'create'])->name('myagenda_gambar.create');
    Route::post('myagenda_gambar', [MyAgendaGambarController::class, 'store'])->name('myagenda_gambar.store');
    Route::get('myagenda_gambar/{id}/edit', [MyAgendaGambarController::class, 'edit'])->name('myagenda_gambar.edit');
    Route::put('myagenda_gambar/{id}', [MyAgendaGambarController::class, 'update'])->name('myagenda_gambar.update');
    Route::delete('myagenda_gambar/{id}', [MyAgendaGambarController::class, 'destroy'])->name('myagenda_gambar.destroy');
});

Route::middleware('role:admin')->group(function () {
    Route::get('myagenda_profile', [MyAgendaProfileController::class, 'index'])->name('myagenda_profile.index');
    Route::get('myagenda_profile/create', [MyAgendaProfileController::class, 'create'])->name('myagenda_profile.create');
    Route::post('myagenda_profile', [MyAgendaProfileController::class, 'store'])->name('myagenda_profile.store');
    Route::get('myagenda_profile/{id}/edit', [MyAgendaProfileController::class, 'edit'])->name('myagenda_profile.edit');
    Route::put('myagenda_profile/{id}', [MyAgendaProfileController::class, 'update'])->name('myagenda_profile.update');
    Route::delete('myagenda_profile/{id}', [MyAgendaProfileController::class, 'destroy'])->name('myagenda_profile.destroy');
});


Route::get('forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('reset-password', 'Auth\ResetPasswordController@reset')->name('password.update');

use Illuminate\Support\Facades\Mail;

// Route::get('/test-email', function() {
//     Mail::raw('Halo sayangkuu, ini email testing dari Laravel!', function($message) {
//         $message->to('indahyutika9@gmail.com') // ganti dengan email tujuan
//                 ->subject('Tes Email Laravel');
//     });

//     return 'Email berhasil dikirim!';
// });

