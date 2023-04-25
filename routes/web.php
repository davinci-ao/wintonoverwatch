<?php
use App\http\Controllers\EventController;
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
});

 Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
     'verified'
 ])->group(function () {
    Route::get('/dashboard', [EventController::class, 'getEvents'])->name('dashboard');
 });

Route::get('/eventform', function(){
    return view('eventform');
});

Route::post('/event/create', [EventController::class, 'create']);
