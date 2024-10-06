<?php

use App\Http\Controllers\Users;
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
    return view('welcome');
})->name('login');

Route::post('login-admin', [Users::class, 'login'])->name('login-admin');

Route::prefix('Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY')->middleware(['web', 'auth', 'AdminMiddleware', 'auth.session', 'auth.basic'])->group(function () {
    // Admin routes
    require_once(__DIR__ . '/__admin.inc.php');
    // Agents routes
    require_once(__DIR__ . '/__agents__.inc.php');
});
