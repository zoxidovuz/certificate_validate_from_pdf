<?php

use App\Http\Controllers\CertificatesController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', 'App\Http\Controllers\CertificatesController@list')->name('certificates.list');
Route::get('certs/download/{certificate}', 'App\Http\Controllers\CertificatesController@downloadCertificate')
    ->name('certificates.download');


Route::middleware('auth')->group(function(){
    Route::get('profile', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

    Route::resource('certificate', CertificatesController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
