<?php

//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;


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

//Route::resource('/companies', App\Http\Controllers\CompanyController::class);

//routes for logins
// Route::get('/', function () {
//     return view('login');
// });
// Route::middleware([HasUserLogin::class])->group(function () {
//     Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('home-page');
//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// Route::resource('/register-user', AuthController::class);
// Route::post('/validate-user', [LoginController::class, 'authenticate'])->name('auth-check');

// Auth::routes();



 
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
 
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('/', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



Route::get('/companies', [ App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [ App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies/store', [ App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/destroy/{demo}', [ App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
Route::get('/companies/edit/{demo}', [ App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
Route::post('/companies/update', [ App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');

