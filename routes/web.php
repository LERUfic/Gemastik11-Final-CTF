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

Route::get('/',function(){ return view('home'); })->name('home');

Route::get('/error', 'HomeController@viewError')->name('error');

Route::get('/logout', 'LoginController@doLogout')->name('login.logout');

Route::get('/home', 'HomeController@index')->name('home');

//Auth
Route::middleware(['guest'])->group(function (){
    Route::get('/login', 'LoginController@viewLogin')->name('login.form');
	Route::post('/login/', 'LoginController@submitLogin')->name('login.submit');
});

Route::middleware(['auth'])->group(function (){
	//Admin
	Route::middleware(['contestant'])->group(function (){
		Route::prefix('admin')->group(function () {
			//Mapping
			Route::get('/dashboard', 'HomeController@viewDashboardAdmin')->name('admin.dashboard');

			//Tambah User Baru
			Route::get('/register', 'LoginController@viewRegister')->name('register.view');
			Route::post('/register', 'LoginController@submitRegister')->name('register.submit');

			//Taruh Flag
			Route::get('/addflag', 'FlagController@viewCreateFlag')->name('flag.create');
			Route::post('/addflag', 'FlagController@submitCreateFlag')->name('flag.createin');

			//Tambah Soal Baru
			Route::get('/soal', 'FlagController@viewSoalForm')->name('soal.form');
			Route::post('/soal', 'FlagController@submitSoal')->name('soal.submit');
    	});

    	Route::get('/scoreboard', 'FlagController@getAllPoin')->name('flag.allscore');
	});

	//Peserta
	Route::prefix('peserta')->group(function () {
		Route::get('/dashboard', 'HomeController@viewDashboardPeserta')->name('peserta.dashboard');
		Route::get('/game', 'FlagController@viewFormSubmit')->name('flag.game');
		Route::post('/game', 'FlagController@submitYourFlag')->name('flag.gamein');

		Route::get('/myscore', 'FlagController@getPoin')->name('flag.myscore');

    });
});
