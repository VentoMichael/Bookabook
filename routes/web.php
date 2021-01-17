<?php

use App\Http\Controllers\{BookController,
    CartController,
    OrderController,
    ReservationController,
    SearchController,
    SettingController,
    StudentController,
    PurchasesStudentController,
    UserController
};
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


Route::prefix('')->middleware(['auth', \App\Http\Middleware\IsStudent::class])->group(function () {
//HOME PAGE
    Route::get('/', [StudentController::class, 'index'])->middleware('auth')->name('dashboardUser.index');

//PURCHASES
    Route::get('/purchases',
        [PurchasesStudentController::class, 'index'])->middleware('auth')->name('purchasesUser.index');

//CART
    Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');

    Route::get('/add-to-cart/{id}', [CartController::class, 'getAddToCart'],
    )->name('product.addToCart');


    Route::get('/shopping-cart', [CartController::class, 'getCart'],
    )->name('product.shoppingCart');


    Route::get('/checkout', [CartController::class, 'checkout'],
    )->name('checkout.index');

    Route::post('/checkout', [CartController::class, 'create'],
    )->name('createOrder.index');


//SETTINGS
    Route::get('/settings', [
        \App\Http\Controllers\SettingStudentController::class, 'index'
    ])->middleware('auth')->name('settingsStudent.index');
});


//USER_DETAILS


Route::prefix('admin')->middleware(['auth', 'can:admin-access'])->group(function () {
//HOME PAGE
    Route::get('/', [UserController::class, 'index'])->name('users.index');

// USERS
    Route::get('/users/suspended', [UserController::class, 'suspended'])->name('users.suspended');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/orders/{id}/edit', [OrderController::class, 'edit'])->name('statuses.edit');
    Route::put('/users/{user}/orders/{id}', [OrderController::class, 'update'])->name('statuses.update');

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


Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
