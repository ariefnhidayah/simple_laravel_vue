<?php

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
    return view('home');
});

Route::get('/belajar', function() {
	$data = [
		['judul' => 'Ini Judul'],
		['judul' => 'Ini Judul'],
		['judul' => 'Ini Judul'],
		['judul' => 'Ini Judul'],
		['judul' => 'Ini Judul']
	];
	return view('belajar.list', compact('data'));
});

Route::get('/belajar/lagi', 'BelajarController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testing', function () {
	return 'hai';
})->middleware('auth');

// Route::get('/biodata', function () {
// 	return 'hai';
// })->name('biodata.index')->middleware('auth');
Route::resource('biodata', 'BiodataController');
Route::post('/biodata/search', 'BiodataController@search')->name('biodata.search');
Route::get('/biodata/search', function () {
	return redirect('biodata.index');
});

// New Route
Route::resource('biodatavue', 'BiodatavueController');