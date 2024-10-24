<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Manage\AccountsController;
use App\Http\Controllers\Manage\mBSIPController;
use App\Http\Controllers\Manage\mJenisStandardController;
use App\Http\Controllers\Manage\mKelompokStandardController;
use App\Http\Controllers\Manage\mLembagaController;
use App\Http\Controllers\Manage\mMetodeController;
use App\Http\Controllers\Manage\mSasaranController;
use App\Http\Controllers\Manage\mServiceController;
use App\Http\Controllers\Manage\mSIPController;
use App\Models\pServiceAccess;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->prefix('/auth')->group(function () {
    Route::get('/login', function () {return view('auth.login');})->name('auth.login.view');
    Route::get('/register', function () {return 'register view';})->name('auth.register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('authenticated')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::middleware('admin')->prefix('/manage')->group(function () {
        Route::get('/', function () {return 'admin dashboard';})->name('manage.dashboard');
        Route::prefix('/accounts')->group(function () {
            Route::put('/{id}/verify', [AccountsController::class, 'verifyUser'])->name('manage.accounts.verify');
            Route::put('/{id}/unverify', [AccountsController::class, 'unverifyUser'])->name('manage.accounts.unverify');
            Route::put('/{id}/service-access-update', [AccountsController::class, 'serviceAccess'])->name('manage.accounts.service_access_update');
            Route::put('/{id}/set-as-admin', [AccountsController::class, 'setAsAdmin'])->name('manage.accounts.set_as_admin');
            Route::put('/{id}/remove-admin', [AccountsController::class, 'removeAdmin'])->name('manage.accounts.remove_admin');
        });
        Route::prefix('/bsip')->group(function () {
            Route::get('/', [mBSIPController::class, 'get'])->name('manage.bsip.view');
            Route::post('/', [mBSIPController::class, 'store'])->name('manage.bsip.store');
            Route::put('/{id}', [mBSIPController::class, 'update'])->name('manage.bsip.update');
            Route::delete('/{id}', [mBSIPController::class, 'destroy'])->name('manage.bsip.destroy');
        });
        Route::prefix('/jenis-standard')->group(function () {
            Route::get('/', [mJenisStandardController::class, 'get'])->name('manage.jenis_standard.view');
            Route::post('/', [mJenisStandardController::class, 'store'])->name('manage.jenis_standard.store');
            Route::put('/{id}', [mJenisStandardController::class, 'update'])->name('manage.jenis_standard.update');
            Route::delete('/{id}', [mJenisStandardController::class, 'destroy'])->name('manage.jenis_standard.destroy');
        });
        Route::prefix('/kelompok-standard')->group(function () {
            Route::get('/', [mKelompokStandardController::class, 'get'])->name('manage.kelompok_standard.view');
            Route::post('/', [mKelompokStandardController::class, 'store'])->name('manage.kelompok_standard.store');
            Route::put('/{id}', [mKelompokStandardController::class, 'update'])->name('manage.kelompok_standard.update');
            Route::delete('/{id}', [mKelompokStandardController::class, 'destroy'])->name('manage.kelompok_standard.destroy');
        });
        Route::prefix('/lembaga')->group(function () {
            Route::get('/', [mLembagaController::class, 'get'])->name('manage.lembaga.view');
            Route::post('/', [mLembagaController::class, 'store'])->name('manage.lembaga.store');
            Route::put('/{id}', [mLembagaController::class, 'update'])->name('manage.lembaga.update');
            Route::delete('/{id}', [mLembagaController::class, 'destroy'])->name('manage.lembaga.destroy');
        });
        Route::prefix('/metode')->group(function () {
            Route::get('/', [mMetodeController::class, 'get'])->name('manage.metode.view');
            Route::post('/', [mMetodeController::class, 'store'])->name('manage.metode.store');
            Route::put('/{id}', [mMetodeController::class, 'update'])->name('manage.metode.update');
            Route::delete('/{id}', [mMetodeController::class, 'destroy'])->name('manage.metode.destroy');
        });
        Route::prefix('/sasaran')->group(function () {
            Route::get('/', [mSasaranController::class, 'get'])->name('manage.sasaran.view');
            Route::post('/', [mSasaranController::class, 'store'])->name('manage.sasaran.store');
            Route::put('/{id}', [mSasaranController::class, 'update'])->name('manage.sasaran.update');
            Route::delete('/{id}', [mSasaranController::class, 'destroy'])->name('manage.sasaran.destroy');
        });
        Route::prefix('/service')->group(function () {
            Route::get('/', [mServiceController::class, 'get'])->name('manage.service.view');
            Route::post('/', [mServiceController::class, 'store'])->name('manage.service.store');
            Route::put('/{id}', [mServiceController::class, 'update'])->name('manage.service.update');
            Route::delete('/{id}', [mServiceController::class, 'destroy'])->name('manage.service.destroy');
        });
        Route::prefix('/sip')->group(function () {
            Route::get('/', [mSIPController::class, 'get'])->name('manage.sip.view');
            Route::post('/', [mSIPController::class, 'store'])->name('manage.sip.store');
            Route::put('/{id}', [mSIPController::class, 'update'])->name('manage.sip.update');
            Route::delete('/{id}', [mSIPController::class, 'destroy'])->name('manage.sip.destroy');
        });
    });
});
