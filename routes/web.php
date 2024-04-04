<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;

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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('task_statuses', TaskStatusController::class)
    ->names([
        'index' => 'task_status.index',
        'create' => 'task_status.create',
        'store' => 'task_status.store',
        'show' => 'task_status.show',
        'edit' => 'task_status.edit',
        'update' => 'task_status.update',
        'destroy' => 'task_status.destroy',
    ]);

Route::resource('labels', LabelController::class)
    ->names([
        'index' => 'label.index',
        'create' => 'label.create',
        'store' => 'label.store',
        'show' => 'label.show',
        'edit' => 'label.edit',
        'update' => 'label.update',
        'destroy' => 'label.destroy',
    ]);

Route::resource('tasks', TaskController::class)
    ->names([
        'index' => 'task.index',
        'create' => 'task.create',
        'store' => 'task.store',
        'show' => 'task.show',
        'edit' => 'task.edit',
        'update' => 'task.update',
        'destroy' => 'task.destroy',
    ]);
