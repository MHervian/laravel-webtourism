<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home;
use App\Http\Controllers\Transportasi;
use App\Http\Controllers\Akomodasi;
use App\Http\Controllers\Wisata;
use App\Http\Controllers\DayaTarik;
use App\Http\Controllers\Kalender;
use App\Http\Controllers\Paket;
use App\Http\Controllers\Emergency;
use App\Http\Controllers\Agen;

use App\Http\Controllers\Admin;

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

/** Enduser endpoints */
// homepage
Route::get('/', [Home::class, 'index'])->name('enduser.homepage');

// transportasi
Route::get('/transportasi/{id_transportasi}', [Transportasi::class, 'index'])->name('enduser.transportasi');

// emergency
Route::get('/emergency', [Emergency::class, 'index'])->name('enduser.emergency');

// akomodasi
Route::get('/akomodasi/{id_akomodasi_cat}', [Akomodasi::class, 'index'])->name('enduser.akomodasi');
Route::get('/akomodasi/{id_akomodasi_cat}/{id_akomodasi}', [Akomodasi::class, 'detail'])->name('enduser.akomodasi.detail');

// agen wisata
Route::get('/agen', [Agen::class, 'index'])->name('enduser.agen');
Route::get('/agen/{id_agen_wisata}', [Agen::class, 'detail'])->name('enduser.agen.detail');

// paket wisata
Route::get('/paket', [Paket::class, 'index'])->name('enduser.paket');
Route::get('/paket/{id_paket}', [Paket::class, 'detail'])->name('enduser.paket.detail');

// peta wisata
Route::get('/wisata', [Wisata::class, 'index'])->name('enduser.petawisata');
Route::get('/wisata/{id_wisata}', [Wisata::class, 'detail'])->name('enduser.petawisata.detail');

// dtw (daya tarik wisata)
Route::get('/daya-tarik', [DayaTarik::class, 'index'])->name('enduser.dayatarik');
Route::get('/daya-tarik/{id_dt_cat}/{id_dt}', [DayaTarik::class, 'detail'])->name('enduser.dayatarik.detail');

// kalender event
Route::get('/kalender', [Kalender::class, 'index'])->name('enduser.kalender');
Route::get('/kalender/{id_kalender}', [Kalender::class, 'detail'])->name('enduser.kalender.detail');

/** Admin endpoints */
// route login admin
Route::get('/admin', [Admin::class, 'index'])->name('admin');
Route::post('/admin', [Admin::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [Admin::class, 'logout'])->name('admin.logout');

// route dashboard admin
Route::get('/admin/dashboard', [Admin::class, 'dashboard'])->name('admin.dashboard');

// route edit homepage admin
Route::get('/admin/edit-homepage', [Home::class, 'indexAdmin'])->name('admin.edithomepage');
Route::post('/admin/edit-homepage/update', [Home::class, 'updateData'])->name('admin.edithomepage.update');

// route transportasi admin
Route::get('/admin/transportasi', [Transportasi::class, 'indexAdmin'])->name('admin.transportasi');
Route::get('/admin/transportasi/form', [Transportasi::class, 'formData'])->name('admin.transportasi.form');
Route::get('/admin/transportasi/{id_transportasi}', [Transportasi::class, 'detailData'])->name('admin.transportasi.detail');
Route::post('/admin/transportasi/create', [Transportasi::class, 'createData'])->name('admin.transportasi.create');
Route::post('/admin/transportasi/update', [Transportasi::class, 'updateData'])->name('admin.transportasi.update');
Route::get('/admin/transportasi/edit/{id_transportasi}', [Transportasi::class, 'editData'])->name('admin.transportasi.edit')->where('id_akomodasi', '[0-9]+');
Route::get('/admin/transportasi/delete/{id_transportasi}', [Transportasi::class, 'deleteData'])->name('admin.transportasi.delete');

// route emergency admin
Route::get('/admin/emergency', [Emergency::class, 'indexAdmin'])->name('admin.emergency');
Route::get('/admin/emergency/form', [Emergency::class, 'formData'])->name('admin.emergency.form');
Route::post('/admin/emergency/create', [Emergency::class, 'createData'])->name('admin.emergency.create');
Route::post('/admin/emergency/update', [Emergency::class, 'updateData'])->name('admin.emergency.update');
Route::get('/admin/emergency/edit/{id_emergency}', [Emergency::class, 'editData'])->name('admin.emergency.edit')->where('id_akomodasi', '[0-9]+');
Route::get('/admin/emergency/delete/{id_emergency}', [Emergency::class, 'deleteData'])->name('admin.emergency.delete');

// route akomodasi admin
Route::get('/admin/akomodasi', [Akomodasi::class, 'indexAdmin'])->name('admin.akomodasi');
Route::get('/admin/akomodasi/form', [Akomodasi::class, 'formData'])->name('admin.akomodasi.form');
Route::post('/admin/akomodasi/create', [Akomodasi::class, 'createData'])->name('admin.akomodasi.create');
Route::post('/admin/akomodasi/update', [Akomodasi::class, 'updateData'])->name('admin.akomodasi.update');
Route::get('/admin/akomodasi/{id_akomodasi}', [Akomodasi::class, 'detailData'])->name('admin.akomodasi.detail')->where('id_akomodasi', '[0-9]+');
Route::get('/admin/akomodasi/edit/{id_akomodasi}', [Akomodasi::class, 'editData'])->name('admin.akomodasi.edit')->where('id_akomodasi', '[0-9]+');
Route::get('/admin/akomodasi/delete/{id_akomodasi}', [Akomodasi::class, 'deleteData'])->name('admin.akomodasi.delete');

Route::get('/admin/akomodasi/kategori', [Akomodasi::class, 'indexAdminKategori'])->name('admin.akomodasi.kategori');
Route::get('/admin/akomodasi/kategori/form', [Akomodasi::class, 'formDataKategori'])->name('admin.akomodasi.kategori.form');
Route::post('/admin/akomodasi/kategori/create', [Akomodasi::class, 'createDataKategori'])->name('admin.akomodasi.kategori.create');
Route::post('/admin/akomodasi/kategori/update', [Akomodasi::class, 'updateDataKategori'])->name('admin.akomodasi.kategori.update');
Route::get('/admin/akomodasi/kategori/edit/{id_akomodasi_cat}', [Akomodasi::class, 'editDataKategori'])
    ->name('admin.akomodasi.kategori.edit')->where('id_akomodasi_cat', '[0-9]+');
Route::get('/admin/akomodasi/kategori/delete/{id_akomodasi_cat}', [Akomodasi::class, 'deleteDataKategori'])->name('admin.akomodasi.kategori.delete');

// route paket
Route::get('/admin/paket', [Paket::class, 'indexAdmin'])->name('admin.paket');
Route::get('/admin/paket/form', [Paket::class, 'formData'])->name('admin.paket.form');
Route::post('/admin/paket/create', [Paket::class, 'createData'])->name('admin.paket.create');
Route::post('/admin/paket/update', [Paket::class, 'updateData'])->name('admin.paket.update');
Route::get('/admin/paket/{id_paket}', [Paket::class, 'detailData'])->name('admin.paket.detail')->where('id_paket', '[0-9]+');
Route::get('/admin/paket/edit/{id_paket}', [Paket::class, 'editData'])->name('admin.paket.edit')->where('id_paket', '[0-9]+');
Route::get('/admin/paket/delete/{id_paket}', [Paket::class, 'deleteData'])->name('admin.paket.delete');

// route agen wisata
Route::get('/admin/agen', [Agen::class, 'indexAdmin'])->name('admin.agen');
Route::get('/admin/agen/form', [Agen::class, 'formData'])->name('admin.agen.form');
Route::post('/admin/agen/create', [Agen::class, 'createData'])->name('admin.agen.create');
Route::post('/admin/agen/update', [Agen::class, 'updateData'])->name('admin.agen.update');
Route::get('/admin/agen/{id_agen_wisata}', [Agen::class, 'detailData'])->name('admin.agen.detail')->where('id_agen', '[0-9]+');
Route::get('/admin/agen/edit/{id_agen_wisata}', [Agen::class, 'editData'])->name('admin.agen.edit')->where('id_agen', '[0-9]+');
Route::get('/admin/agen/delete/{id_agen_wisata}', [Agen::class, 'deleteData'])->name('admin.agen.delete');

// route destinasi wisata
Route::get('/admin/wisata', [Wisata::class, 'indexAdmin'])->name('admin.wisata');
Route::get('/admin/wisata/form', [Wisata::class, 'formData'])->name('admin.wisata.form');
Route::post('/admin/wisata/create', [Wisata::class, 'createData'])->name('admin.wisata.create');
Route::post('/admin/wisata/update', [Wisata::class, 'updateData'])->name('admin.wisata.update');
Route::get('/admin/wisata/{id_wisata}', [Wisata::class, 'detailData'])->name('admin.wisata.detail')->where('id_wisata', '[0-9]+');
Route::get('/admin/wisata/edit/{id_wisata}', [Wisata::class, 'editData'])->name('admin.wisata.edit')->where('id_wisata', '[0-9]+');
Route::get('/admin/wisata/delete/{id_wisata}', [Wisata::class, 'deleteData'])->name('admin.wisata.delete');

Route::get('/admin/wisata/kategori', [Wisata::class, 'indexAdminKategori'])->name('admin.wisata.kategori');
Route::get('/admin/wisata/kategori/form', [Wisata::class, 'formDataKategori'])->name('admin.wisata.kategori.form');
Route::post('/admin/wisata/kategori/create', [Wisata::class, 'createDataKategori'])->name('admin.wisata.kategori.create');
Route::post('/admin/wisata/kategori/update', [Wisata::class, 'updateDataKategori'])->name('admin.wisata.kategori.update');
Route::get('/admin/wisata/kategori/edit/{id_wisata_cat}', [Wisata::class, 'editDataKategori'])
    ->name('admin.wisata.kategori.edit')->where('id_wisata_cat', '[0-9]+');
Route::get('/admin/wisata/kategori/delete/{id_wisata_cat}', [Wisata::class, 'deleteDataKategori'])->name('admin.wisata.kategori.delete');

// route aktivitas
Route::get('/admin/aktivitas', [DayaTarik::class, 'indexAdmin'])->name('admin.aktivitas');
Route::get('/admin/aktivitas/form', [DayaTarik::class, 'formData'])->name('admin.aktivitas.form');
Route::post('/admin/aktivitas/create', [DayaTarik::class, 'createData'])->name('admin.aktivitas.create');
Route::post('/admin/aktivitas/update', [DayaTarik::class, 'updateData'])->name('admin.aktivitas.update');
Route::get('/admin/aktivitas/{id_dt}', [DayaTarik::class, 'detailData'])->name('admin.aktivitas.detail')->where('id_dt', '[0-9]+');
Route::get('/admin/aktivitas/edit/{id_dt}', [DayaTarik::class, 'editData'])->name('admin.aktivitas.edit')->where('id_dt', '[0-9]+');
Route::get('/admin/aktivitas/delete/{id_dt}', [DayaTarik::class, 'deleteData'])->name('admin.aktivitas.delete');

Route::get('/admin/aktivitas/kategori', [DayaTarik::class, 'indexAdminKategori'])->name('admin.aktivitas.kategori');
Route::get('/admin/aktivitas/kategori/form', [DayaTarik::class, 'formDataKategori'])->name('admin.aktivitas.kategori.form');
Route::post('/admin/aktivitas/kategori/create', [DayaTarik::class, 'createDataKategori'])->name('admin.aktivitas.kategori.create');
Route::post('/admin/aktivitas/kategori/update', [DayaTarik::class, 'updateDataKategori'])->name('admin.aktivitas.kategori.update');
Route::get('/admin/aktivitas/kategori/edit/{id_dt_cat}', [DayaTarik::class, 'editDataKategori'])
    ->name('admin.aktivitas.kategori.edit')->where('id_dt_cat', '[0-9]+');
Route::get('/admin/aktivitas/kategori/delete/{id_dt_cat}', [DayaTarik::class, 'deleteDataKategori'])->name('admin.aktivitas.kategori.delete');

// route event/kalender
Route::get('/admin/kalender', [Kalender::class, 'indexAdmin'])->name('admin.kalender');
Route::get('/admin/kalender/form', [Kalender::class, 'formData'])->name('admin.kalender.form');
Route::post('/admin/kalender/create', [Kalender::class, 'createData'])->name('admin.kalender.create');
Route::post('/admin/kalender/update', [Kalender::class, 'updateData'])->name('admin.kalender.update');
Route::get('/admin/kalender/{id_kalender}', [Kalender::class, 'detailData'])->name('admin.kalender.detail')->where('id_kalender', '[0-9]+');
Route::get('/admin/kalender/edit/{id_kalender}', [Kalender::class, 'editData'])->name('admin.kalender.edit')->where('id_kalender', '[0-9]+');
Route::get('/admin/kalender/delete/{id_kalender}', [Kalender::class, 'deleteData'])->name('admin.kalender.delete');

Route::get('/admin/kalender/kategori', [Kalender::class, 'indexAdminKategori'])->name('admin.kalender.kategori');
Route::get('/admin/kalender/kategori/form', [Kalender::class, 'formDataKategori'])->name('admin.kalender.kategori.form');
Route::post('/admin/kalender/kategori/create', [Kalender::class, 'createDataKategori'])->name('admin.kalender.kategori.create');
Route::post('/admin/kalender/kategori/update', [Kalender::class, 'updateDataKategori'])->name('admin.kalender.kategori.update');
Route::get('/admin/kalender/kategori/edit/{id_kalender_cat}', [Kalender::class, 'editDataKategori'])
    ->name('admin.kalender.kategori.edit')->where('id_kalender_cat', '[0-9]+');
Route::get('/admin/kalender/kategori/delete/{id_kalender_cat}', [Kalender::class, 'deleteDataKategori'])->name('admin.kalender.kategori.delete');