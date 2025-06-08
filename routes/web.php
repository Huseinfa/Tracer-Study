<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\KuisionerLulusanController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KuisionerStakeholderController;
use App\Http\Controllers\LulusanController;
use App\Http\Controllers\MasaTungguController;
use App\Http\Controllers\RekapLulusanController;
use App\Models\KuisionerStakeholderModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WelcomeController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
	Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
	Route::resource('admin', AdminController::class);
});

Route::prefix('lulusan')->middleware(['auth'])->group(function () {
    Route::get('/', [LulusanController::class, 'index'])->name('lulusan.index');
    Route::get('/create', [LulusanController::class, 'create'])->name('lulusan.create');
    Route::post('/store', [LulusanController::class, 'store'])->name('lulusan.store');
    Route::get('/{id}/edit', [LulusanController::class, 'edit'])->name('lulusan.edit');
    Route::put('/{id}', [LulusanController::class, 'update'])->name('lulusan.update');
    Route::delete('/{id}', [LulusanController::class, 'destroy'])->name('lulusan.destroy');

    // Route Import/Export
    Route::get('lulusan/export', [LulusanController::class, 'export'])->name('lulusan.export.form');
    Route::get('lulusan/import', function () {
        return view('lulusan.import');
    })->name('lulusan.import.form');

    // Tambahkan untuk proses POST import:
    Route::post('lulusan/import', [LulusanController::class, 'import'])->name('lulusan.import');

    Route::resource('lulusan', LulusanController::class);
});

Route::prefix('stakeholder')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('stakeholder.index');
    Route::post('/store', [AdminController::class, 'store'])->name('stakeholder.store');
	Route::get('/export', [AdminController::class, 'export'])->name('stakeholder.export');
	Route::resource('stakeholder', StakeholderController::class);
});

Route::get('/masa-tunggu/lulusan', [MasaTungguController::class, 'lulusan'])->name('masa-tunggu.lulusan');
Route::get('/masa-tunggu/rata-rata', [MasaTungguController::class, 'rataRata'])->name('masa-tunggu.rata-rata');

// 
// 
// kuisioner start
// 
// 

// kuisioner lulusan routes start
Route::group(['prefix' => 'tracer-study'], function () {
	Route::get('/', [KuisionerLulusanController::class, 'index'])->name('tracer-study.index');
	Route::post('/cari', [KuisionerLulusanController::class, 'cari']);
	Route::get('/konfirmasi/{id}', [KuisionerLulusanController::class, 'konfirmasi'])->name('tracer-study.konfirmasi');
	Route::get('/kembali', [KuisionerLulusanController::class, 'kembali']);
	Route::get('/terimakasih', [KuisionerLulusanController::class, 'terimakasih'])->name('tracer-study.thanks');
	
	Route::middleware('search')->group(function () {
		Route::post('/terkonfirmasi/{id}', [KuisionerLulusanController::class, 'terkonfirmasi']);
		Route::get('/otp/{id}', [KuisionerLulusanController::class, 'otp'])->name('tracer-study.otp');
		Route::post('/kode-OTP-baru/{id}', [KuisionerLulusanController::class, 'kirimUlang']);
		Route::post('/verifikasi/{id}', [KuisionerLulusanController::class, 'verifikasi']);
		
		Route::middleware('otpLulusan')->group(function () {
			Route::get('/kuisioner/{id}', [KuisionerLulusanController::class, 'kuisioner'])->name('tracer-study.kuisioner');
			Route::get('/getProfesi/{id_kategori}', [KuisionerLulusanController::class, 'getProfesi'])->name('tracer-study.getProfesi');
			Route::post('/simpan/{id}', [KuisionerLulusanController::class, 'simpan']);
		});
	});
});
// kuisioner lulusan routes end

// kuisioner atasan routes start
Route::group(['prefix' => 'survey-kepuasan'], function () {
	Route::get('/terimakasih', [KuisionerStakeholderController::class, 'terimakasih'])->name('survey-kepuasan.thanks');
	Route::get('/{kode}', [KuisionerStakeholderController::class, 'index'])->name('survey-kepuasan.index');
	Route::post('/simpan/{id}', [KuisionerStakeholderController::class, 'simpan']);
});
// kuisioner atasan routes end

// 
// 
// kuisioner end
// 
// 

Route::get('/rekap-lulusan', [RekapLulusanController::class, 'index'])->name('rekap.index');

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');

});