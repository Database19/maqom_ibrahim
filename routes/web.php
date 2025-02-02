<?php

use Illuminate\Support\Facades\Route;
use App\Models\PaketUmrah;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    // Module
    Route::prefix('jamaahs')->group(function () {
        Route::resource('/daftar-jamaah', \App\Http\Controllers\JamaahController::class)->names('daftar-jamaah');
        Route::resource('/daftar-umrah', \App\Http\Controllers\DaftarUmrahController::class)->names('daftar-umrah');
    });


    Route::prefix('layanans')->group(function () {
        Route::resource('/paket-umrah', \App\Http\Controllers\PaketUmrahController::class)->names('paket-umrah');
    });




    Route::get('api/provinces', function () {
        return getProvinces();
    })->name('api.provinces');

    Route::get('api/regencies/{provinceId}', function ($provinceId) {
        return getRegencies($provinceId);
    })->name('api.regencies');

    Route::get('api/districts/{regencyId}', function ($regencyId) {
        return getDistricts($regencyId);
    })->name('api.districts');

    Route::get('api/villages/{districtId}', function ($districtId) {
        return getVillages($districtId);
    })->name('api.villages');


    // Find Rencana Keberangkatan
    Route::get('api/rencana-keberangkatan/{kode_paket}', function ($kode_paket) {
        return PaketUmrah::select('tanggal_keberangkatan')->where('kode_paket', $kode_paket)->first();
    });
});

Route::post('buku-tamu', [\App\Http\Controllers\JamaahController::class, 'guest'])->name('buku-tamu');


