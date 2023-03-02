<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\RecipeController;
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
Route::get('/', [FrontController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::get('/', [RecipeController::class, 'index']);
Route::get('/', [FrontController::class, 'home']);
Route::get('recipes', [FrontController::class, 'index']);
Route::get('recipe/{id}', [FrontController::class, 'show'])->whereNumber('id');

Route::middleware('auth')->group(function () {
    Route::get('admin/categories', [CategoriesController::class, 'index']);
    Route::get('admin/categories/create', [CategoriesController::class, 'create']);
    Route::post('admin/categories/create', [CategoriesController::class, 'store']);
    Route::any('admin/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::delete('admin/categories/delete/{id}', [CategoriesController::class, 'delete'])->name('category.delete');
    Route::get('admin/categories/{id}', [CategoriesController::class, 'show']);

    Route::get('admin/ingredient', [IngredientController::class, 'index']);
    Route::get('admin/ingredient/create', [IngredientController::class, 'create']);
    Route::post('admin/ingredient/create', [IngredientController::class, 'store']);
    Route::any('admin/ingredient/edit/{id}', [IngredientController::class, 'edit'])->name('ingredient.edit');
    Route::delete('admin/ingredient/delete/{id}', [IngredientController::class, 'delete'])->name('ingredient.delete');
    Route::get('admin/ingredient/{id}', [IngredientController::class, 'show']);

    Route::get('admin/recipe', [RecipeController::class, 'index']);
    Route::get('admin/recipe/create', [RecipeController::class, 'create']);
    Route::post('admin/recipe/create', [RecipeController::class, 'store']);
    Route::any('admin/recipe/edit/{id}', [RecipeController::class, 'edit'])->name('recipe.edit');
    Route::delete('admin/recipe/delete/{id}', [RecipeController::class, 'delete'])->name('recipe.delete');
    Route::get('admin/recipe/{id}', [RecipeController::class, 'show']);
});
require __DIR__.'/auth.php';
