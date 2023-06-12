<?php
use App\http\Controllers\EventController;
use App\http\Controllers\CompanyController;
use App\http\Controllers\UserController;
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

Route::get('/', [EventController::class, 'getEvents'])->name('dashboard');

Route::get('/dashboard', [EventController::class, 'getEvents'])->name('dashboard');

Route::get('/eventform', function(){
    return view('eventform');
});

Route::get('/companyform', function(){
    return view('companyform');
});

Route::get('/profile/{id}', [UserController::class, 'getUser']);

Route::get('/profile/edit/{id}', [UserController::class, 'viewForm']);

Route::post('/profile/update', [UserController::class, 'updateUser']);

Route::get('/companyoverview', [CompanyController::class, 'getCompanies'])->name('companyoverview');

Route::get('/eventcompanies/{id}', [CompanyController::class, 'getList']);

Route::get('/company/{id}', [CompanyController::class, 'getDetails']);

Route::post('/company/create', [CompanyController::class, 'create']);

Route::get('/event/{id}', [EventController::class, 'getDetails']);

Route::post('/event/create', [EventController::class, 'create']);

Route::post('/event/company/add', [EventController::class, 'addCompanies']);

Route::get('/edit/{id}', [EventController::class, 'edit'])->name('eventEdit');

Route::post('/{id}', [EventController::class, 'update'])->name('eventUpdate');

Route::get('/companyedit/{id}', [CompanyController::class, 'companyedit'])->name('companyedit');

Route::post('/company/{id}', [CompanyController::class, 'update'])->name('companyUpdate');

Route::post('/eventjoin/{id}', [EventController::class, 'join'])->name('event.join');

Route::get('/event/signup/{id}', [EventController::class, 'signup']);

Route::get('/event/signout/{id}', [EventController::class, 'signout']);
