<?php
namespace App\Http\Controllers;

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
    return view('auth.login');
});
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('custom-login',[LoginController::class,'customLogin'])->name('login.custom');
Route::get('logout', [LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('companies', CompanyController::class);
Route::get('/company/get_table_data', [CompanyController::class, 'get_table_data'])->name('company.get_table_data');
Route::resource('employees', EmployeeController::class);
Route::get('/empolyee/get_data_table', [EmployeeController::class, 'get_data_table'])->name('employees.get_data_table');




});
