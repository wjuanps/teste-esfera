<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasUuid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Company extends Model {

  use HasFactory, HasUuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'site',
  ];

  public function createCompany(Request $request) {
    $error = null;
    $company = null;
    DB::transaction(function () use ($request, &$error, &$company) {
      try {
        $company = $this->create([
          "name" => Str::ucfirst($request->company_name),
          "email" => Str::lower($request->company_email),
          "site" => Str::lower($request->company_site)
        ]);
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    if ($company) {
      return $company;
    }

    return null;
  }

  public function updateCompany(Request $request, $company_id) {
    $error = null;
    $company = null;
    DB::transaction(function () use ($request, &$error, &$company, $company_id) {
      try {
        $company = Company::where('id', $company_id)
          ->update([
            "name" => Str::ucfirst($request->company_name),
            "email" => Str::lower($request->company_email),
            "site" => Str::lower($request->company_site)
          ]
        );
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    return $company;
  }

  public function getCompany($company_id) {
    return $this->find($company_id);
  }

  public function getCompanies($search = "") {
    return $this->where(function ($query) use ($search) {
      $query->where('name', 'like', "%{$search}%")
        ->orWhere('site', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%");
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10);
  }

  public function getEmployee($employee_id) {
    return $this->employees()
      ->find($employee_id);
  }

  public function getEmployees($search = "") {
    return $this->employees()
      ->where(function ($query) use ($search) {
        $query->where('first_name', 'like', "%{$search}%")
          ->orWhere('last_name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate(10);
  }

  public function deleteCompany() {
    if (isset($this->logo)) {
      LocalFile::removeFile(public_path('storage/' . $this->logo->patch));
      LocalFile::removeDirectory(public_path('storage/' . $this->id));
    }

    return $this->delete();
  }

  public function associateLogo(Logo $logo) {
    $this->logo()->save($logo);
  }

  public function associateAddress(Address $address) {
    $this->address()->save($address);
  }

  public function employees() {
    return $this->hasMany(Employee::class);
  }

  public function logo() {
    return $this->hasOne(Logo::class);
  }

  public function address() {
    return $this->hasOne(Address::class);
  }
}
