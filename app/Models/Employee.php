<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasUuid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Employee extends Model {

  use HasFactory, HasUuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
  ];

  public function createEmployee(Request $request, Company $company) {
    $employee = null;
    $error = null;
    DB::transaction(function () use ($request, &$employee, $company, &$error) {
      try {
        $employee = $company->employees()->create([
          "first_name" => Str::ucfirst($request->employee_first_name),
          "last_name" => Str::ucfirst($request->employee_last_name),
          "email" => Str::lower($request->employee_email),
          "phone" => $request->employee_phone
        ]);
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    if ($employee) {
      return $employee;
    }

    return null;
  }

  public function updateEmployee(Request $request, $employee_id) {
    $error = null;
    $employee = null;
    DB::transaction(function () use ($request, &$error, &$employee, $employee_id) {
      try {
        $employee = Employee::where('id', $employee_id)
          ->update([
            "first_name" => Str::ucfirst($request->employee_first_name),
            "last_name" => Str::ucfirst($request->employee_last_name),
            "email" => Str::lower($request->employee_email),
            "phone" => $request->employee_phone
          ]
        );
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    return $employee;
  }

  public function deleteEmployee() {
    return $this->delete();
  }

  public function getEmployee($employee_id) {
    return $this->find($employee_id);
  }

  public function getEmployees($search = "") {
    return $this->leftJoin('companies', 'employees.company_id', '=', 'companies.id')
      ->where(function ($query) use ($search) {
        $query->where('employees.first_name', 'like', "%{$search}%")
          ->orWhere('employees.last_name', 'like', "%{$search}%")
          ->orWhere('employees.email', 'like', "%{$search}%")
          ->orWhere('companies.name', 'like', "%{$search}%")
          ->orWhere('companies.email', 'like', "%{$search}%");
      })
      ->orderBy('employees.created_at', 'desc')
      ->paginate(10);
  }

  public function company() {
    return $this->belongsTo(Company::class);
  }

  public function associateAddress(Address $address) {
    $this->address()->save($address);
  }

  public function address() {
    return $this->hasOne(Address::class);
  }
}
