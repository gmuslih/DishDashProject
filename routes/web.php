<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Recipe CRUD routes
    Route::get('/recipes/create', [UserController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [UserController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [UserController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [UserController::class, 'update'])->name('recipes.update');
    // List all recipes (index page) - This is crucial
// Route::get('/recipes', [UserController::class, 'index'])->name('recipes.index');

    // Delete recipe route (Admin or Owner)
    Route::delete('/recipes/{id}/remove', [UserController::class, 'remove'])->name('recipes.remove');
    Route::delete('/recipes/{id}/remove-saved', [UserController::class, 'removeSavedRecipe'])->name('recipes.removeSavedRecipe');
});

// Public Routes
Route::get('/features', function () {
    return view('features');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/recipes/search', [UserController::class, 'search'])->name('recipes.search');
Route::post('/recipes/save', [UserController::class, 'save'])->name('recipes.save');

// Show a single recipe
Route::get('/recipe/{id}', [UserController::class, 'show'])->name('recipes.show');


// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// routes/web.php  to login dashboard
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::delete('/recipes/{recipe}', [AdminController::class, 'destroy'])->name('recipes.destroy');

