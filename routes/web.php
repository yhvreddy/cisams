<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
    return redirect()->route('login');
});

Route::get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha')->name('generate.captcha');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/login', 'HomeController@login')->name('login');
    Route::post('/login-access', 'HomeController@loginAccess')->name('login.access');

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', 'HomeController@logout')->name('logout');
        Route::get('/home', 'HomeController@index')->name('home');

        Route::prefix('complaints')->name('complaints.')->group(function () {
            Route::get('/financial', 'ComplaintsController@financial')->name('financial');
            Route::get('/non-financial', 'ComplaintsController@nonFinancial')->name('non-financial');
        });

        Route::prefix('case-status')->name('case-status.')->group(function () {
            Route::get('/pe', 'CaseStatusController@index')->name('pe');
            Route::get('/pe-fir-no', 'CaseStatusController@peFirNo')->name('pe-fir-no');
            Route::get('/pe-fir-kyc', 'CaseStatusController@peFirKyc')->name('pe-fir-kyc');
            Route::get('/pe-fir-cdr', 'CaseStatusController@peFirCdr')->name('pe-fir-cdr');
        });

        Route::prefix('fir-conversions')->name('fir-conversions.')->group(function () {
            Route::prefix('complaints')->group(function () {
                Route::get('/', 'FIRConversionsController@index')->name('complaints');
            });

                Route::get('/tc-yes', 'FIRConversionsController@tcYes')->name('tc-yes');
                Route::get('/fc-yes', 'FIRConversionsController@fcYes')->name('fc-yes');
                Route::get('/uf-update', 'FIRConversionsController@ufUpdate')->name('uf-update');
                Route::get('/ur-update', 'FIRConversionsController@urUpdate')->name('ur-update');
                Route::get('/ro-pending', 'FIRConversionsController@roPending')->name('ro-pending');
                Route::get('/sro-pending', 'FIRConversionsController@sroPending')->name('sro-pending');

                Route::get('/ev-no', 'FIRConversionsController@evNo')->name('ev-no');
                Route::get('/eg-no', 'FIRConversionsController@egNo')->name('eg-no');
                Route::get('/whatsapp-pending', 'FIRConversionsController@whatsAppPending')->name('whatsapp-pending');

        });
    });
});


Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return "Storage linked";
})->name('storage.link');

Route::get('/migrate-refresh', function () {
    Artisan::call('migrate:fresh --seed');
    return "Migration Refreshed";
})->name('migrate.fresh');

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "Migration Run";
})->name('migrate');
