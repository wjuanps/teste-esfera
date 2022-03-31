<?php

namespace App\Http\Controllers\Roles\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller {

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Company $company, Employee $employee) {
    $companies = $company->getCompanies();
    $employees = $employee->getEmployees();

    return view('admin.home', compact('companies', 'employees'));
  }
}
