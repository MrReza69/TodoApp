<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function(){return view('home');})->name('home');

//categories
#region categories routes
Route::get('/categories/create',[CategoryController::class, 'create'])->name('category.create')->middleware('auth');
Route::post('/categories',[CategoryController::class, 'store'])->name('category.store')->middleware('auth');
Route::get('/categories', [categoryController::class, 'index'])->name('category.index')->middleware('auth');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit')->middleware('auth');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update')->middleware('auth');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('auth');
#endregion

//todos
#region todos routes
Route::get('/todos', [TodoController::class , 'index'])->name("todo.index")->middleware('auth');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todo.create')->middleware('auth');
Route::post('/todos', [TodoController::class,'store'])->name('todo.store')->middleware('auth');
Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todo.show')->middleware('auth');
Route::get('/todos/{todo}/completed', [TodoController::class, 'completed'])->name('todo.completed')->middleware('auth');
Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit')->middleware('auth');
Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todo.update')->middleware('auth');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy')->middleware('auth');

#endregion

//users
#region users routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class , 'Dashboard'])->middleware('auth')->name('dashboard');



#endregion
