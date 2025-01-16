<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Kinerja\DiseminasiController;
use App\Http\Controllers\Kinerja\IdentifikasiController;
use App\Http\Controllers\Kinerja\PendampinganController;
use App\Http\Controllers\Direktori\RisetController;
use App\Http\Controllers\Manage\AccountsController;
use App\Http\Controllers\Manage\mBSIPController;
use App\Http\Controllers\Manage\mIP2SIPController;
use App\Http\Controllers\Manage\mJenisStandardController;
use App\Http\Controllers\Manage\mKabupatenController;
use App\Http\Controllers\Manage\mKecamatanController;
use App\Http\Controllers\Manage\mKelompokStandardController;
use App\Http\Controllers\Manage\mLembagaController;
use App\Http\Controllers\Manage\mMetodeController;
use App\Http\Controllers\Manage\mProvinsiController;
use App\Http\Controllers\Manage\mSasaranController;
use App\Http\Controllers\Manage\mServiceController;
use App\Http\Controllers\Manage\mSIPController;
use App\Http\Controllers\IP2SIP\ProvinceDashboardController;
use App\Http\Controllers\IP2SIP\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Direktori\PenyuluhController;
use App\Http\Controllers\IP2SIP\AsetAlatController;
use App\Http\Controllers\IP2SIP\AsetGedungController;
use App\Http\Controllers\IP2SIP\AsetLabController;
use App\Http\Controllers\IP2SIP\AsetRumahController;
use App\Http\Controllers\IP2SIP\AsetTanahController;
use App\Http\Controllers\IP2SIP\DetailPemanfaatanSipController;
use App\Http\Controllers\IP2SIP\PemanfaatanSIPController;
use App\Http\Controllers\Lab\LaboratoriumController;
use App\Http\Controllers\Manage\AdminDashboardController;
use App\Http\Controllers\Manage\BsipProfileController;
use App\Http\Controllers\Manage\CMSController;
use App\Http\Controllers\Manage\CommonDataController;
use App\Http\Controllers\Manage\ManageGalleryController;
use App\Http\Controllers\Manage\mFungsionalController;
use App\Http\Controllers\Manage\mJenisLabController;
use App\Http\Controllers\Manage\mKelasBenihController;
use App\Http\Controllers\Manage\mKomoditasController;
use App\Http\Controllers\Perbenihan\PerbenihanController;
use App\Models\mService;
use Illuminate\Support\Facades\Crypt;

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

Route::get('/', [GuestController::class, 'home'])->name('home');


Route::middleware('guest')->prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('auth.login.view');
    Route::get('/register', [AuthController::class, 'registerView'])->name('auth.register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('authenticated')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/auth/no-service', function() {return view('auth.noService');})->middleware('noservice')->name('auth.no_service');
    
    Route::middleware('admin')->prefix('/manage')->group(function () {
        Route::get('/test', function () {
            return view('api-test.index');
        });
        Route::get('/', [AdminDashboardController::class, 'index'])->name('manage.dashboard');
        Route::prefix('/common')->group(function () {
            Route::get('/{name}/{table}', [CommonDataController::class, 'index'])->name('manage.data.common');
            Route::post('/{table}', [CommonDataController::class, 'store'])->name('manage.data.common.store');
            Route::put('/{table}/{id}', [CommonDataController::class, 'update'])->name('manage.data.common.update');
            Route::delete('/{table}/{id}', [CommonDataController::class, 'destroy'])->name('manage.data.common.destroy');
        });
        Route::prefix('/cms')->group(function () {
            Route::get('/', [CMSController::class, 'index'])->name('manage.cms.view');
            Route::put('/cms-update', [CMSController::class, 'cms_update'])->name('manage.cms.update');
            Route::post('/social-store', [CMSController::class, 'social_store'])->name('manage.social.store');
            Route::put('/social-update/{id}', [CMSController::class, 'social_update'])->name('manage.social.update');
            Route::delete('/social-destroy/{id}', [CMSController::class, 'social_destroy'])->name('manage.social.destroy');
        });
        Route::prefix('/service')->group(function () {
            Route::get('/', [mServiceController::class, 'get'])->name('manage.service.view');
            // Route::post('/', [mServiceController::class, 'store'])->name('manage.service.store');
            // Route::put('/{id}', [mServiceController::class, 'update'])->name('manage.service.update');
            Route::put('/{id}/lock', [mServiceController::class, 'lock'])->name('manage.service.lock');
            Route::put('/{id}/unlock', [mServiceController::class, 'unlock'])->name('manage.service.unlock');
            // Route::delete('/{id}', [mServiceController::class, 'destroy'])->name('manage.service.destroy');
        });
        Route::prefix('/accounts')->group(function () {
            Route::get('/', [AccountsController::class, 'index'])->name('manage.accounts.view');
            Route::put('/{id}/verify', [AccountsController::class, 'verifyUser'])->name('manage.accounts.verify');
            Route::put('/{id}/unverify', [AccountsController::class, 'unverifyUser'])->name('manage.accounts.unverify');
            Route::put('/{id}/service-access-update', [AccountsController::class, 'serviceAccess'])->name('manage.accounts.service_access_update');
            Route::put('/{id}/set-as-admin', [AccountsController::class, 'setAsAdmin'])->name('manage.accounts.set_as_admin');
            Route::put('/{id}/remove-admin', [AccountsController::class, 'removeAdmin'])->name('manage.accounts.remove_admin');
        });
        Route::prefix('/provinsi')->group(function () {
            Route::get('/', [mProvinsiController::class, 'get'])->name('manage.provinsi.view');
            Route::post('/', [mProvinsiController::class, 'store'])->name('manage.provinsi.store');
            Route::put('/{id}', [mProvinsiController::class, 'update'])->name('manage.provinsi.update');
            Route::delete('/{id}', [mProvinsiController::class, 'destroy'])->name('manage.provinsi.destroy');
        });
        Route::prefix('/kabupaten')->group(function () {
            Route::get('/', [mKabupatenController::class, 'get'])->name('manage.kabupaten.view');
            Route::post('/', [mKabupatenController::class, 'store'])->name('manage.kabupaten.store');
            Route::put('/{id}', [mKabupatenController::class, 'update'])->name('manage.kabupaten.update');
            Route::delete('/{id}', [mKabupatenController::class, 'destroy'])->name('manage.kabupaten.destroy');
        });
        Route::prefix('/kecamatan')->group(function () {
            Route::get('/', [mKecamatanController::class, 'get'])->name('manage.kecamatan.view');
            Route::post('/', [mKecamatanController::class, 'store'])->name('manage.kecamatan.store');
            Route::put('/{id}', [mKecamatanController::class, 'update'])->name('manage.kecamatan.update');
            Route::delete('/{id}', [mKecamatanController::class, 'destroy'])->name('manage.kecamatan.destroy');
        });
        Route::prefix('/bsip')->group(function () {
            Route::get('/', [mBSIPController::class, 'get'])->name('manage.bsip.view');
            Route::post('/', [mBSIPController::class, 'store'])->name('manage.bsip.store');
            Route::put('/{id}', [mBSIPController::class, 'update'])->name('manage.bsip.update');
            Route::delete('/{id}', [mBSIPController::class, 'destroy'])->name('manage.bsip.destroy');
        });
        Route::prefix('/ip2sip')->group(function () {
            Route::get('/', [mIP2SIPController::class, 'get'])->name('manage.ip2sip.view');
            Route::post('/', [mIP2SIPController::class, 'store'])->name('manage.ip2sip.store');
            Route::put('/{id}', [mIP2SIPController::class, 'update'])->name('manage.ip2sip.update');
            Route::delete('/{id}', [mIP2SIPController::class, 'destroy'])->name('manage.ip2sip.destroy');
        });
        Route::prefix('/profile-bsip')->group(function () {
            Route::get('/', [BsipProfileController::class, 'manage'])->name('manage.profile_bsip.index');
            Route::post('/store', [BsipProfileController::class, 'store'])->name('manage.profile_bsip.store');
            Route::put('/{id}/update', [BsipProfileController::class, 'update'])->name('manage.profile_bsip.update');
            Route::delete('/{id}/destroy', [BsipProfileController::class, 'destroy'])->name('manage.profile_bsip.destroy');
        });
        Route::prefix('/gallery')->group(function () {
            Route::get('/', [ManageGalleryController::class, 'manage'])->name('manage.gallery.index');
            Route::post('/store', [ManageGalleryController::class, 'store'])->name('manage.gallery.store');
            Route::put('/{id}/update', [ManageGalleryController::class, 'update'])->name('manage.gallery.update');
            Route::delete('/{id}/destroy', [ManageGalleryController::class, 'destroy'])->name('manage.gallery.destroy');
        });
    });

    Route::middleware(['service:1', 'lock_service:1'])->prefix('/kinerja-kegiatan')->group(function () {
        Route::prefix('/identifikasi')->group(function () {
            Route::get('/form', [IdentifikasiController::class, 'create'])->name('form_sip');
            Route::post('/', [IdentifikasiController::class, 'store'])->name('kinerja.identifikasi.store');
            Route::put('/{id}', [IdentifikasiController::class, 'update'])->name('kinerja.identifikasi.update');
            Route::delete('/{id}', [IdentifikasiController::class, 'destroy'])->name('kinerja.identifikasi.destroy');
        });
        Route::prefix('/diseminasi')->group(function () {
            Route::get('/form', function () { return view('kinerja.diseminasi.form_peserta'); })->name('diseminasi.form_peserta'); // Adjust the view path if necessary
            Route::get('/form-sektor', [DiseminasiController::class, 'create'])->name('diseminasi.form_sektor');
            Route::post('/', [DiseminasiController::class, 'store'])->name('kinerja.diseminasi.store');
            Route::put('/{id}', [DiseminasiController::class, 'update'])->name('kinerja.diseminasi.update');
            Route::delete('/{id}', [DiseminasiController::class, 'destroy'])->name('kinerja.diseminasi.destroy');
        });
        Route::prefix('/pendampingan')->group(function () {
            Route::get('/form', [PendampinganController::class, 'create'])->name('pendampingan_form');
            Route::post('/', [PendampinganController::class, 'store'])->name('kinerja.pendampingan.store');
            Route::put('/{id}', [PendampinganController::class, 'update'])->name('kinerja.pendampingan.update');
            Route::delete('/{id}', [PendampinganController::class, 'destroy'])->name('kinerja.pendampingan.destroy');
        });
    });

    Route::middleware(['service:2', 'lock_service:2'])->prefix('/lab-pengujian')->group(function () {
        Route::get('/form', [LaboratoriumController::class, 'create'])->name('form-Lab');
        Route::post('/', [LaboratoriumController::class, 'store'])->name('lab.store');
        Route::put('/{id}', [LaboratoriumController::class, 'update'])->name('lab.update');
        Route:: delete('/{id}', [LaboratoriumController::class, 'destroy'])->name('lab.destroy');
        Route::get('/laboratoriumview/{id}', [LaboratoriumController::class, 'showDetail'])->name('lab.detail');
        
    });

    Route::middleware(['service:3', 'lock_service:3'])->prefix('/perbenihan')->group(function () {
        Route::get('/form', [PerbenihanController::class, 'create'])->name('perbenihan.form');
        Route::post('/', [PerbenihanController::class, 'store'])->name('perbenihan.store');
        Route::put('/{id}', [PerbenihanController::class, 'update'])->name('perbenihan.update');
        Route::delete('/{id}', [PerbenihanController::class, 'destroy'])->name('perbenihan.destroy');
    });

    Route::middleware(['service:4', 'lock_service:4'])->prefix('/ip2sip')->group(function () {
        Route::prefix('/pemanfaatan_kp')->group(function () {
            Route::get('/form', [PemanfaatanSIPController::class, 'create'])->name('lp2tp.pemanfaatan_kp.create');
            Route::post('/store', [PemanfaatanSIPController::class, 'store'])->name('lp2tp.pemanfaatan_kp.store');
            Route::get('/lp2tp/pemanfaatan_kp/export', [PemanfaatanSIPController::class, 'exportExcel'])->name('lp2tp.pemanfaatan_kp.export');
            Route::prefix('/detail')->group(function () {
                Route::get('/create', [DetailPemanfaatanSipController::class, 'create'])->name('lp2tp.pemanfaatan_kp.detail.create');
                Route::post('/store', [DetailPemanfaatanSipController::class, 'store'])->name('lp2tp.pemanfaatan_kp.detail.store');
                Route::get('/{id}/edit', [DetailPemanfaatanSipController::class, 'edit'])->name('lp2tp.pemanfaatan_kp.detail.edit');
                Route::put('/{id}/update', [DetailPemanfaatanSipController::class, 'update'])->name('lp2tp.pemanfaatan_kp.detail.update');
                Route::delete('/{id}/destroy', [DetailPemanfaatanSipController::class, 'destroy'])->name('lp2tp.pemanfaatan_kp.detail.destroy');
            });
        });
        Route::prefix('/aset')->group(function () {
            Route::prefix('/tanah')->group(function () {
                Route::post('/', [AsetTanahController::class, 'store'])->name('aset.tanah.store');
                Route::put('/{id}', [AsetTanahController::class, 'update'])->name('aset.tanah.update');
                Route::delete('/{id}', [AsetTanahController::class, 'destroy'])->name('aset.tanah.destroy');
            });
            Route::prefix('/gedung')->group(function () {
                Route::post('/', [AsetGedungController::class, 'store'])->name('aset.gedung.store');
                Route::put('/{id}', [AsetGedungController::class, 'update'])->name('aset.gedung.update');
                Route::delete('/{id}', [AsetGedungController::class, 'destroy'])->name('aset.gedung.destroy');
            });
            Route::prefix('/lab')->group(function () {
                Route::post('/', [AsetLabController::class, 'store'])->name('aset.lab.store');
                Route::put('/{id}', [AsetLabController::class, 'update'])->name('aset.lab.update');
                Route::delete('/{id}', [AsetLabController::class, 'destroy'])->name('aset.lab.destroy');
            });
            Route::prefix('/rumah-negara')->group(function () {
                Route::post('/', [AsetRumahController::class, 'store'])->name('aset.rumah.store');
                Route::put('/{id}', [AsetRumahController::class, 'update'])->name('aset.rumah.update');
                Route::delete('/{id}', [AsetRumahController::class, 'destroy'])->name('aset.rumah.destroy');
            });
            Route::prefix('/alat-mesin')->group(function () {
                Route::post('/', [AsetAlatController::class, 'store'])->name('aset.alat.store');
                Route::put('/{id}', [AsetAlatController::class, 'update'])->name('aset.alat.update');
                Route::delete('/{id}', [AsetAlatController::class, 'destroy'])->name('aset.alat.destroy');
            });
        });
    });

    Route::middleware(['service:5', 'lock_service:5'])->prefix('/direktori-penyuluh')->group(function () {
        Route::prefix('/penyuluh')->group(function () {
            Route::post('/', [PenyuluhController::class, 'store'])->name('direktori_penyuluh.penyuluh.store');
            Route::put('/{id}', [PenyuluhController::class, 'update'])->name('direktori_penyuluh.penyuluh.update');
            Route::delete('/{id}', [PenyuluhController::class, 'destroy'])->name('direktori_penyuluh.penyuluh.destroy');
        });
        Route::prefix('/riset')->group(function () {
            Route::post('/', [RisetController::class, 'store'])->name('direktori_penyuluh.riset.store');
            Route::put('/{id}', [RisetController::class, 'update'])->name('direktori_penyuluh.riset.update');
            Route::delete('/{id}', [RisetController::class, 'destroy'])->name('direktori_penyuluh.riset.destroy');
        });
        Route::get('/formsdm', [PenyuluhController::class, 'create'])->name('formsdm');
        Route::get('/formriset', [RisetController::class, 'create'])->name('formriset');
    });
});

// (1) KINERJA KEGIATAN
Route::prefix('/kinerja-kegiatan')->middleware('lock_service:1')->group(function () {
    Route::get('/', function () { return view('kinerja.berandakinerja'); })->name('beranda_kinerja');
    Route::prefix('/identifikasi')->group(function () {
        Route::get('/', [IdentifikasiController::class, 'index'])->name('identifikasi_beranda');
        Route::get('/provinsi/{bsip_id}', [IdentifikasiController::class, 'provinsi'])->name('identifikasi.provinsi');
        Route::post('/provinsi', [IdentifikasiController::class, 'filter_provinsi'])->name('identifikasi.provinsi.filter');
    });
    Route::prefix('/diseminasi')->group(function () {
        Route::get('/', [DiseminasiController::class, 'index'])->name('diseminasi_beranda');
        Route::get('/provinsi/{bsip_id}', [DiseminasiController::class, 'provinsi'])->name('diseminasi.provinsiDiseminasi');
        Route::post('/provinsi', [DiseminasiController::class, 'filter_provinsi'])->name('diseminasi.provinsi.filter');
        Route::get('/peserta', function () { return view('kinerja.diseminasi.peserta'); })->name('diseminasi.peserta');
        Route::get('/sip-sub-sektor', function () { return view('kinerja.diseminasi.sip_sub_sektor'); })->name('diseminasi.sip_sub_sektor');
    });
    Route::prefix('/pendampingan')->group(function () {
        Route::get('/', [PendampinganController::class, 'index'])->name('pendampingan_main');
        Route::get('/tabel-data/{bsip_id}', [PendampinganController::class, 'show'])->name('pendampingan_tabel');
        Route::get('/{id}/detail-data', [PendampinganController::class, 'detail'])->name('pendampingan_detail');
    });

});
// (1) END KINERJA KEGIATAN
// (2) LAB PENGUJIAN
Route::prefix('/lab-pengujian')->middleware('lock_service:2')->group(function () {
    Route::get('/', [LaboratoriumController::class, 'index'])->name('beranda-Lab');
    Route::get('/data-Lab', [LaboratoriumController::class, 'show'])->name('data-Lab');
});
// (2) END LAB PENGUJIAN
// (3) PERBENIHAN
Route::prefix('/perbenihan')->middleware('lock_service:3')->group(function () {
    Route::get('/', [PerbenihanController::class, 'index'])->name('perbenihan.index');
    Route::get('/provinsi/{bsip_id}', [PerbenihanController::class, 'provinsi'])->name('perbenihan.provinsi');
});
// (3) END PERBENIHAN
// (4) IP2SIP
Route::prefix('/ip2sip')->middleware('lock_service:4')->group(function () {
    Route::get('/', function () { return view('lp2tp.dashboard-lp2tp'); })->name('dashboard-lp2tp');
    Route::get('/profil_bsip', function () {
        return view('lp2tp.profil_bsip');
    })->name('profil_bsip');    
    
    Route::prefix('/aset')->group(function () {
        Route::get('/tanah', [AsetTanahController::class, 'index'])->name('aset.tanah');
        Route::get('/gedung', [AsetGedungController::class, 'index'])->name('aset.gedung');
        Route::get('/lab', [AsetLabController::class, 'index'])->name('aset.lab');
        Route::get('/rumah_negara', [AsetRumahController::class, 'index'])->name('aset.rumah_negara');
        Route::get('/alat_mesin', [AsetAlatController::class, 'index'])->name('aset.alat_mesin');
    });
    Route::get('/tabelPeta/{bsip_id}', [ProvinceDashboardController::class, 'show'])->name('ip2sip.provinsi');
    Route::prefix('/pemanfaatan_kp')->group(function () {
        Route::get('/', [PemanfaatanSIPController::class, 'index'])->name('lp2tp.pemanfaatan_kp');
        Route::get('/{pemanfaatan_id}/detail', [DetailPemanfaatanSipController::class, 'index'])->name('lp2tp.pemanfaatan_kp.detail');
    });
    Route::get('/galeri', [GalleryController::class, 'index'])->name('lp2tp.galeri');
});
// (4) END IP2SIP
// (5) DIREKTORI SDM
Route::prefix('/direktori-sdm')->middleware('lock_service:5')->group(function () {
    Route::get('/pengkajian-sdm', [PenyuluhController::class, 'index'])->name('sdm');
    Route::get('/pengkajian-riset', [RisetController::class, 'index'])->name('riset');
});
// (5) END DIREKTORI SDM

Route::get('/service/locked/{id}', function ($id) {
    $service = mService::find(Crypt::decryptString($id));
    if (!$service->is_locked) return back();
    return view('auth.lockedService');
})->name('service.locked');

//profile//

Route::get('/profil-daerah', [BsipProfileController::class, 'index'])->name('profile.bsip');

Route::get('/identifikasi/provinsi/{bsip_id}/export-pdf', [IdentifikasiController::class, 'exportPdf'])->name('identifikasi.provinsi.export-pdf');

Route::get('/diseminasi/export_pdf', [DiseminasiController::class, 'exportPdf'])->name('diseminasi.export_pdf');

Route::get('/pemanfaatan/detail', function () {
    return view('lp2tp.pemanfaatan.detail');
})->name('lp2tp_detail');
// Route::get('/diseminasi/peserta', function () {
//     return view('kinerja.diseminasi.peserta'); 
// })->name('diseminasi.peserta');

// Route::get('/diseminasi/sip-sub-sektor', function () {
//     return view('kinerja.diseminasi.sip_sub_sektor');
// })->name('diseminasi.sip_sub_sektor');

// Route::get('/diseminasi/form', function () {
//     return view('kinerja.diseminasi.form_peserta'); // Adjust the view path if necessary
// })->name('diseminasi.form_peserta');