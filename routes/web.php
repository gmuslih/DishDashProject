<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    // List all recipes (index page) - This is crucial
// Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

    // Delete recipe route (Admin or Owner)
    Route::delete('/recipes/{id}/remove', [RecipeController::class, 'remove'])->name('recipes.remove');
    Route::delete('/recipes/{id}/remove-saved', [RecipeController::class, 'removeSavedRecipe'])->name('recipes.removeSavedRecipe');
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
Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::post('/recipes/save', [RecipeController::class, 'save'])->name('recipes.save');

// Show a single recipe
Route::get('/recipe/{id}', [RecipeController::class, 'show'])->name('recipes.show');


// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
