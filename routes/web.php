<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\KuisionerLulusanController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KuisionerStakeholderController;
use App\Http\Controllers\LulusanController;
use App\Http\Controllers\MasaTungguController;
use App\Http\Controllers\LaporanController;



Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
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


Route::middleware('auth')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::group(['prefix' => 'admin'], function () {
		Route::get('/', [AdminController::class, 'index'])->name('admin.index');
		Route::post('/list', [AdminController::class, 'list']);
		Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
		Route::post('/store', [AdminController::class, 'store']);
		Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
		Route::put('/{id}', [AdminController::class, 'update']);
		Route::get('/{id}/delete', [AdminController::class, 'confirmDelete'])->name('admin.confirm-delete');
		Route::delete('/{id}/destroy', [AdminController::class, 'destroy']);
	});

	Route::group(['prefix' => 'lulusan'], function () {
		Route::get('/', [LulusanController::class, 'index'])->name('lulusan.index');
		Route::post('/list', [LulusanController::class, 'list']);
		Route::get('/{id}/show', [LulusanController::class, 'show'])->name('lulusan.show');
		Route::get('/create', [LulusanController::class, 'create'])->name('lulusan.create');
		Route::post('/store', [LulusanController::class, 'store']);
		Route::get('/{id}/edit', [LulusanController::class, 'edit'])->name('lulusan.edit');
		Route::put('/{id}', [LulusanController::class, 'update']);
		Route::get('/{id}/delete', [LulusanController::class, 'confirmDelete'])->name('lulusan.confirmDelete');
		Route::delete('/{id}/destroy', [LulusanController::class, 'destroy']);
		Route::get('/export', [LulusanController::class, 'export'])->name('lulusan.export');
		Route::get('/import', [LulusanController::class, 'import'])->name('lulusan.import');
		Route::post('/store-import', [LulusanController::class, 'storeImport']);
	});

	Route::group(['prefix' => 'stakeholder'], function () {
		Route::get('/', [StakeholderController::class, 'index'])->name('stakeholder.index');
		Route::post('/list', [StakeholderController::class, 'list'])->name('stakeholder.list');
		Route::post('/show', [StakeholderController::class, 'show'])->name('stakeholder.show');
		Route::get('/export', [StakeholderController::class, 'export'])->name('stakeholder.export');
	});

	Route::group(['prefix' => 'masa-tunggu'], function () {
		Route::get('/', [MasaTungguController::class, 'index'])->name('masa-tunggu.index');
		Route::post('/list-perLulusan', [MasaTungguController::class, 'perLulusan'])->name('masa-tunggu.list-perLulusan');
		Route::post('/list-perTahun', [MasaTungguController::class, 'perTahun'])->name('masa-tunggu.list-perTahun');
	});

	Route::group(['prefix' => 'laporan'], function () {
		Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
		Route::post('/list-tracer', [LaporanController::class, 'tracerStudy'])->name('laporan.tracerStudy');
		Route::post('/list-survey', [LaporanController::class, 'kepuasanStakeholder'])->name('laporan.surveyStakeholder');
		Route::post('/list-lulusan', [LaporanController::class, 'lulusanBelumMengisi'])->name('laporan.lulusanBelumMengisi');
		Route::post('/list-stakeholder', [LaporanController::class, 'stakeholderBelumMengisi'])->name('laporan.stakeholderBelumMengisi');
		Route::get('/unduh-laporan', [LaporanController::class, 'exportLaporan'])->name('laporan.exportLaporan');
	});

	Route::post('sign-out', [SessionsController::class, 'destroy'])->name('logout');
});


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