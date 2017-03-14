<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
| 
*/

Route::get('/', 'PagesController@homepage');
Route::get('/home', 'PagesController@homepage');


Auth::routes();

#Laporan
Route::get('laporan', 'LaporanController@harian');


#monitoring
Route::get('/monitoring', 'MonitoringController@index');
Route::get('/dateline', 'MonitoringController@dateline');
Route::get('/monitoring/survei', 'MonitoringController@ajax');
Route::post('/monitoring/pegawai', 'MonitoringController@survei');

#profil
Route::get('/profil/', 'ProfilController@index');
Route::get('/profil/edit', 'ProfilController@edit');
Route::get('upload', function() {
  return View::make('pages.upload');
});
Route::post('profil/upload', 'ProfilController@upload');
Route::post('profil/lapor', 'ProfilController@lapor');


#beban kerja
Route::get('/beban', 'PagesController@beban');
Route::get('/beban/import', 'BebanController@import');
Route::post('/beban/upload', 'BebanController@upload');
Route::get('beban/show', 'BebanController@show');
Route::get('beban/beban_ramal_ga', 'BebanController@beban_ramal_ga');
Route::get('beban/beban_ramal_bobot', 'BebanController@beban_ramal_bobot');
Route::get('beban/beban_bagi_rata', 'BebanController@beban_bagi_rata');


#ckpr
Route::get('/ckpr/import', 'CkprController@import');
Route::post('/ckpr/upload', 'CkprController@upload');
Route::get('ckpr/show', 'CkprController@show');
Route::post('ckpr/show', 'CkprController@show');

#Produktifitas
Route::get('/produktifitas/import', 'ProduktifitasController@import');
Route::get('produktifitas/ajax', 'ProduktifitasController@survei');
Route::post('/produktifitas/upload', 'ProduktifitasController@upload');
Route::get('produktifitas/show', 'ProduktifitasController@show');
Route::post('produktifitas/show', 'ProduktifitasController@show');

#pegawai
Route::get('/pegawai/create', 'PegawaiController@create');
Route::post('/pegawai/store', 'PegawaiController@store');
Route::get('/pegawai/show', 'PegawaiController@show');
Route::get('pegawai/{pegawai}', 'PegawaiController@detail');
Route::delete('/pegawai/{pegawai}', 'PegawaiController@delete');
Route::get('pegawai/edit/{pegawai}', 'PegawaiController@edit');
Route::post('pegawai/update', 'PegawaiController@update');

#survei
Route::get('/survei/create', 'SurveiController@create');
Route::post('/survei/store', 'SurveiController@store');
Route::get('/survei/show', 'SurveiController@show');
Route::get('/survei/{survei}', 'SurveiController@detail');
Route::delete('/survei/{survei}', 'SurveiController@delete');
Route::get('/survei/edit/{survei}', 'SurveiController@edit');
Route::post('/survei/update', 'SurveiController@update');

#jadwal
Route::get('jadwal', 'JadwalController@index');
Route::get('jadwal/ajax', 'JadwalController@survei');
Route::get('jadwal/pilih_pegawai', 'JadwalController@pilih_pegawai');
Route::get('jadwal/pilih_pegawai1', 'JadwalController@pilih_pegawai1');
Route::get('jadwal/csv', 'JadwalController@csv');
Route::get('jadwal/respond', 'JadwalController@responden');
Route::get('jadwal/jadwal', 'JadwalController@jadwal');
Route::post('jadwal/jadwal', 'JadwalController@jadwal');

#laporan
Route::get('laporan/harian', 'LaporanController@harian');
Route::get('laporan/harian/detil', 'LaporanController@detil');
Route::post('laporan/harian/detil/simpan','LaporanController@edit_harian');