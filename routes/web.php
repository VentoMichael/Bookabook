<?php

use App\Http\Controllers\{BookController,
    DashboardController,
    LoginController,
    ReservationController,
    SearchController,
    SettingController,
    UserController
};
use App\Http\Middleware\IsAdmin;
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
Route::get('/test', function () {
});

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.homeindex');


Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
//HOME PAGE
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// USERS
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


    Route::get('/users/{user}/status/{id}/edit', [UserController::class, 'statusEdit'])->name('users.statusedit');
    Route::put('/users/{user}/status/{id}', [UserController::class, 'statusEditUpdate'])->name('users.statusUpdate');

// BOOKS
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/draft', [BookController::class, 'draft'])->name('books.draft');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit/', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

//SEARCH
    Route::any('/search', [SearchController::class, 'index'])->name('search.index');

//PURCHASES
    Route::get('/purchases', [ReservationController::class, 'index'])->name('purchases.index');
    Route::put('/purchases', [ReservationController::class, 'sendNotif'])->name('purchases.sendNotif');

//SETTINGS
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});
