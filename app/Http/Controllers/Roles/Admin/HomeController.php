<?php

namespace App\Http\Controllers\Roles\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;

class HomeController extends Controller {

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Company $company, Employee $employee) {
    $companyCount  = $company->getCompaniesCount();
    $employeeCount = $employee->getEmployeesCount();

    return view('admin.home', compact('companyCount', 'employeeCount'));
  }
}
