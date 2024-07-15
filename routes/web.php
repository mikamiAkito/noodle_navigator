<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GoogleMapsController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/noodle-nav', function () {
    return Inertia::render('HomePage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'googlemaps' => env('GOOGLE_MAPS_API_KEY'),
        'isLogin' => Auth::check(),
    ]);
})->name('noodlenav');

//ホームページルート
// Route::get('/noodle-nav', function () {
//     return Inertia::render('HomePage', ['googlemaps' => env('GOOGLE_MAPS_API_KEY')]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('HomePage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'googlemaps' => env('GOOGLE_MAPS_API_KEY'),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'image'])->name('profile.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/bookMark', [GoogleMapsController::class, 'bookMarkEvent'])->name('bookMark.Event');
    Route::get('/bookMark-List', [GoogleMapsController::class, 'bookMarkList'])->name('bookMark.List');
    Route::post('/bookMark-delete', [GoogleMapsController::class, 'bookMarkDelete'])->name('bookMark.Delete');
    Route::post('/bookMark-check', [GoogleMapsController::class, 'bookMarkCheck'])->name('bookMark.Check');
    Route::get('/bookMark-select/{placeId}', function ($placeId) {
        return Inertia::render('HomePage', [
            'placeId' => $placeId ? $placeId : 'NOTID',
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'googlemaps' => env('GOOGLE_MAPS_API_KEY'),
            'isLogin' => Auth::check(),
        ]);
    })->name('bookMark.Select');
});

require __DIR__ . '/auth.php';
