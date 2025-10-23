<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin UI Dashboard Routes with prefix
Route::prefix('adminui')->group(function () {
    
    // Route utama adminui - redirect ke login jika belum login, ke dashboard jika sudah login
    Route::get('/', function () {
        if (auth()->check()) {
            return redirect()->route('adminui.dashboard');
        }
        return redirect()->route('adminui.login');
    })->name('adminui.index');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', function () {
            return view('dashboard');
        })->name('adminui.dashboard');
        
        Route::get('billing', function () {
            return view('billing');
        })->name('adminui.billing');
        
        Route::get('profile', function () {
            return view('profile');
        })->name('adminui.profile');
        
        Route::get('rtl', function () {
            return view('rtl');
        })->name('adminui.rtl');
        
        Route::get('tables', function () {
            return view('tables');
        })->name('adminui.tables');
        
        Route::get('virtual-reality', function () {
            return view('virtual-reality');
        })->name('adminui.virtual-reality');
        
        Route::get('user-profile', [InfoUserController::class, 'create'])->name('adminui.user-profile');
        Route::post('user-profile', [InfoUserController::class, 'store']);
        Route::get('user-management', function () {
            return view('laravel-examples.user-management');
        })->name('adminui.user-management');
    });
    
    Route::group(['middleware' => 'guest'], function () {
        Route::get('register', [RegisterController::class, 'create'])->name('adminui.register');
        Route::post('register', [RegisterController::class, 'store']);
        
        Route::get('login', [SessionsController::class, 'create'])->name('adminui.login');
        Route::post('login', [SessionsController::class, 'store']);
        
        Route::get('login/forgot-password', [ResetController::class, 'create']);
        Route::post('forgot-password', [ResetController::class, 'sendEmail']);
        Route::get('reset-password/{token}', [ResetController::class, 'resetPass'])->name('adminui.password.reset');
        Route::post('reset-password', [ChangePasswordController::class, 'changePassword'])->name('adminui.password.update');
    });
    
    Route::post('logout', [SessionsController::class, 'destroy'])->name('adminui.logout');
});

// Original Laravel routes (keep existing functionality)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
