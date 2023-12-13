<?php

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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', 'App\Http\Controllers\HomeController@index');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {
    
    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])->name('activation-required');
    
    // Reset success Routes
    Route::get('/password/reseted', ['uses' => 'App\Http\Controllers\Auth\PasswordResetedController@index'])->name('password.reseted');

    // Log out
    Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    // Route::get('/home', 'App\Http\Controllers\UserController@index')->name('home');
    Route::get('home', [
        'as'   => 'home.show',
        'uses' => 'App\Http\Controllers\UserController@index',
    ]);

    // Show users profile.
    Route::get('store/{uuid}', [
        'as'   => '{uuid}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
    
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {

    Route::patch('store/{uuid}', [
        'as'   => 'profile.update',
        'uses' => 'App\Http\Controllers\ProfilesController@update',
    ]);

    // Show carports.
    Route::get('carport', [
        'as'   => 'carport.show',
        'uses' => 'App\Http\Controllers\UserController@carportShow',
    ]);

    Route::put('carport', [
        'as'   => 'carport.store',
        'uses' => 'App\Http\Controllers\UserController@carportStore',
    ]);

    Route::put('carport/{id}', [
        'as'   => 'carport.update',
        'uses' => 'App\Http\Controllers\UserController@carportUpdate',
    ]);

    Route::post('ajax-carport', [
        'as'   => 'ajax-carport.show',
        'uses' => 'App\Http\Controllers\UserController@ajaxCarportShow',
    ]);

    Route::post('search-carport', [
        'as'   => 'search-carport',
        'uses' => 'App\Http\Controllers\UserController@searchCarports',
    ]);

    // Show inovices.
    Route::get('invoice', [
        'as'   => 'invoice.show',
        'uses' => 'App\Http\Controllers\UserController@invoiceShow',
    ]);

    // Show power.
    Route::get('power-register', [
        'as'   => 'power.register',
        'uses' => 'App\Http\Controllers\UserController@powerRegister',
    ]);

    Route::post('dropzone-store', [
        'as'   => 'dropzone.store',
        'uses' => 'App\Http\Controllers\UserController@dropzoneStore',
    ]);

    Route::put('invoice', [
        'as'   => 'invoice.update',
        'uses' => 'App\Http\Controllers\UserController@invoiceUpdate',
    ]);

    Route::post('invoice/zip', [
        'as'   => 'invoice.zipfile',
        'uses' => 'App\Http\Controllers\UserController@invoiceZipfile',
    ]);

    Route::get('invoice/{uuid}', [
        'as'   => 'invoice.download',
        'uses' => 'App\Http\Controllers\UserController@invoiceDownload',
    ]);

});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('stores', \App\Http\Controllers\StoreController::class, [
        'names' => [
            'index'   => 'stores',
            'destroy' => 'store.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('contract_types', \App\Http\Controllers\ContractTypeController::class, [
        'names' => [
            'index'   => 'contract_types',
            'destroy' => 'contract_type.destroy',
        ],
    ]);

    Route::post('search-users', 'App\Http\Controllers\StoreController@search')->name('search-users');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('active-users', 'App\Http\Controllers\AdminDetailsController@activeUsers');

});

Route::redirect('/php', '/phpinfo', 301);
