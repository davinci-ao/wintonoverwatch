<?php
use App\http\Controllers\EventController;
use App\http\Controllers\CompanyController;
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

Route::get('/companyform', function(){
    return view('companyform');
});

Route::get('/companyoverview', [CompanyController::class, 'getCompanies'])->name('companyoverview');

Route::get('/company/{id}', [CompanyController::class, 'getDetails']);

Route::post('/company/create', [CompanyController::class, 'create']);

Route::get('/event/{id}', [EventController::class, 'getDetails']);

Route::post('/event/create', [EventController::class, 'create']);

Route::get('/edit/{id}', [EventController::class, 'edit'])->name('eventEdit');

Route::post('/{id}', [EventController::class, 'update'])->name('eventUpdate');
