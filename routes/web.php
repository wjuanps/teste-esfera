<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Roles\Admin\CompanyController;
use App\Http\Controllers\Roles\Admin\EmployeeController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Roles\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Roles\Company\HomeController as CompanyHomeController;
use App\Http\Controllers\Roles\Employee\HomeController as EmployeeHomeController;

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

Route::get('/login', [ LoginController::class, 'showLoginForm' ])->name('login');
Route::post('/logout', [ LoginController::class, 'logout' ])->name('logout');
Route::post('/login', [ LoginController::class, 'login' ]);

Route::get('/', [ HomeController::class, 'index' ])->name('home');
Route::get('/home', [ HomeController::class, 'index' ])->name('home');

Route::middleware('UserAdmin')->prefix('admin')->group(function() {
  Route::get('/', [ AdminHomeController::class, 'index' ])->name('user_admin.home');

  Route::prefix('/companies')->group(function () {
    Route::get('/', [ CompanyController::class, 'index' ])->name('user_admin.company.index');
    Route::get('/create', [ CompanyController::class, 'showCreateCompanyForm' ])->name('user_admin.company.new');
    Route::post('/create', [ CompanyController::class, 'create' ])->name('user_admin.company.create');
    Route::get('/{company_id}', [ CompanyController::class, 'show' ])->name('user_admin.company.show');
    Route::get('/{company_id}/edit', [ CompanyController::class, 'showUpdateCompanyForm' ])->name('user_admin.company.edit');
    Route::put('/{company_id}/edit', [ CompanyController::class, 'handleEdit' ])->name('user_admin.company.handle.edit');
    Route::delete('/{company_id}/delete', [ CompanyController::class, 'handleDelete' ])->name('user_admin.company.handle.delete');

    Route::prefix('{company_id}/employees')->group(function() {
      Route::get('/create', [ EmployeeController::class, 'showCreateEmployeeForm' ])->name('user_admin.employee.new');
      Route::post('/create', [ EmployeeController::class, 'create'])->name('user_admin.employee.create');
      Route::get('/{employee_id}', [ EmployeeController::class, 'showUpdateEmployeeForm' ])->name('user_admin.employee.show');
      Route::put('/{employee_id}/edit', [ EmployeeController::class, 'handleEdit' ])->name('user_admin.employee.handle.edit');
      Route::delete('/{employee_id}/delete', [ EmployeeController::class, 'handleDelete' ])->name('user_admin.employee.handle.delete');
    });
  });

  Route::get('/employees', [ EmployeeController::class, 'index' ])->name('user_admin.employee.index');
});

Route::middleware('UserCompany')->prefix('company')->group(function () {
  Route::get('/', [ CompanyHomeController::class, 'index' ])->name('user_company.home');
});

Route::middleware('UserEmployee')->prefix('employee')->group(function () {
  Route::get('/', [ EmployeeHomeController::class, 'index' ])->name('user_employee.home');
});
