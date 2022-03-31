<?php

namespace App\Http\Controllers\Roles\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Address;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller {

  public function index(Request $request, Employee $employee) {
    try {
      $employees = $employee->getEmployees($request->search);
      $search = $request->search;

      return view('admin.employees.index', compact('employees', 'search'));
    } catch (\Throwable $th) {
      dd($th);
    }
  }

  public function showUpdateEmployeeForm(Request $request, Company $company) {
    try {
      $company = $company->getCompany($request->company_id);
      $employee = $company->getEmployee($request->employee_id);

      if (isset($company) && isset($employee)) {
        return view('admin.employees.show', compact('company', 'employee'));
      } else {
        return redirect()->back()
          ->with('error', 'Error loading employee');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error loading employee');
    }
  }

  public function showCreateEmployeeForm(Request $request) {
    try {
      $company_id = $request->company_id;

      return view('admin.employees.create', compact('company_id'));
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error loading employee');
    }
  }

  public function create(EmployeeRequest $request, Company $company, Employee $employee, Address $address) {
    try {
      $company = $company->getCompany($request->company_id);
      $employee = $employee->createEmployee($request, $company);

      if ((isset($company) && $company instanceof Company) && (isset($employee) && $employee instanceof Employee)) {
        $address = $address->saveAddress($request);

        if (isset($address) && $address instanceof Address) {
          $employee->associateAddress($address);
        }

        return redirect()->route('user_admin.company.show', [ "company_id" => $company->id ])
          ->with('created', 'Employee successfully created');
      } else {
        return redirect()->back()
          ->with('error', 'Error creating employee');
      }
    } catch (\Throwable $th) {
      dd($th);
      return redirect()->back()
        ->with('error', 'Error creating employee');
    }
  }

  public function handleEdit(EmployeeRequest $request, Company $company, Employee $employee, Address $address) {
    try {
      $company = $company->getCompany($request->company_id);
      $employee = $company->getEmployee($request->employee_id);

      if (isset($company) && isset($employee)) {
        $employee->updateEmployee($request, $employee->id);

        if (isset($employee->address)) {
          $address->updateAddress($request, $employee->address->id);
        } else {
          $address = $address->saveAddress($request);

          if (isset($address) && $address instanceof Address) {
            $employee->associateAddress($address);
          }
        }

        return redirect()->back()
          ->with('updated', 'Employee successfully updated');
      } else {
        return redirect()->back()
          ->with('error', 'Error updating employee');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error updating employee');
    }
  }

  public function handleDelete(Request $request, Company $company, Employee $employee) {
    try {
      $company = $company->getCompany($request->company_id);
      $employee = $company->getEmployee($request->employee_id);

      if ((isset($company) && $company instanceof Company) && (isset($employee) && $employee instanceof Employee))  {
        $isEmployeeDeleted = $employee->deleteEmployee();

        if ($isEmployeeDeleted) {
          return redirect()->route('user_admin.company.show', [ "company_id" => $company->id ])
            ->with('deleted', 'Employee successfully deleted');
        } else {
          return redirect()->back()
            ->with('error', 'Error deleting employee');
        }
      } else {
        return redirect()->back()
          ->with('error', 'Error deleting employee');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error deleting employee');
    }
  }
}
