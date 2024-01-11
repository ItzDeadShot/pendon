<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('/');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/donated-items', function () {
    $items = \App\Models\Item::all();
    return view('items', compact('items'));
})->name('donated-items');


Route::middleware('auth')->group(function () {
    // Profile CRUD
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Resource CRUD
    Route::resource('users', UserController::class)->except(['create', 'edit']);
    Route::resource('items', ItemController::class)->except(['create']);
    Route::resource('requests', RequestController::class)->except(['create', 'edit']);

    Route::post('/requests/request-item', [RequestController::class, 'storeFromItems'])->name('requests.item.store');
});

//Route::group(['middleware' => ['auth', 'role:admin']], function () {
//});
//
//Route::group(['middleware' => ['role:admin', 'role:donor']], function () {
//
//});

Route::post('/images', [ImageController::class, 'store']);
//    ->middleware(['auth']);

Route::get('/images/{file}', [ImageController::class, 'showFile'])->name('images.showFile');
//    ->middleware(['auth']);


require __DIR__.'/auth.php';
