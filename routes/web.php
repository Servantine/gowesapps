<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RouteListController;
use App\Http\Controllers\Admin\BundleController;
use App\Http\Controllers\Admin\DestinasiController;
use App\Http\Controllers\Admin\PenginapanController;
use App\Http\Controllers\Admin\RestoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\RouteSuggestionController;


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

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [PageController::class, 'visitor'])->name('visitor.welcome');
Route::get('/kontak', [PageController::class, 'kontak'])->name('visitor.kontak');

Route::get('/saran-rute', [RouteSuggestionController::class, 'create'])->name('suggestions.create');
Route::post('/saran-rute', [RouteSuggestionController::class, 'store'])->name('suggestions.store');


Route::get('/rutelist', [RouteListController::class, 'index'])->name('rutelist');
Route::get('/detailrute/{bundle}', [RouteListController::class, 'show'])->name('rute.detail');
Route::get('/detailrute', [PageController::class, 'detailrute'])->name('visitor.rutelist');
Route::get('/pembayaran', [PageController::class, 'pembayaran'])->name('visitor.pembayaran');
Route::post('/detailrute/{bundle}/reviews', [ReviewController::class, 'store'])->name('reviews.store');


Route::get('/pembayaran', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/pembayaran', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/pembayaran/sukses', [PaymentController::class, 'success'])->name('payment.success');


Route::get('/user/home', [PageController::class, 'userHome'])->name('user.home');

Route::get('/visitor', [PageController::class, 'visitor'])->name('visitor.welcome');

Route::get('/home', [PageController::class, 'home'])->name('home')->middleware('role:user');

Route::get('/user', [PageController::class, 'home'])
    ->name('user')
    ->middleware('role:user'); // Middleware untuk memastikan hanya user yang dapat mengakses home

// Halaman utama admin, bisa berupa dashboard statis atau redirect
Route::get('/admin', function () {
    // Kita arahkan saja ke halaman utama manajemen bundle
    return redirect()->route('bundles.index');
})->middleware('role:admin')->name('admin.dashboard');


// Grup untuk semua route admin
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::resource('bundles', BundleController::class);
    Route::resource('restos', RestoController::class);
    Route::resource('destinasis', DestinasiController::class);
    Route::resource('penginapans', PenginapanController::class);
    Route::resource('bookings', BookingController::class);
    Route::patch('bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('/saran-rute', [RouteSuggestionController::class, 'adminIndex'])->name('suggestions.index');
    Route::patch('/saran-rute/{suggestion}/status', [RouteSuggestionController::class, 'updateStatus'])->name('suggestions.updateStatus');
    Route::delete('/saran-rute/{suggestion}', [RouteSuggestionController::class, 'destroy'])->name('suggestions.destroy');
});