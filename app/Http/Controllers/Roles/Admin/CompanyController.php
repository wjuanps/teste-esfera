<?php

namespace App\Http\Controllers\Roles\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Company;
use App\Models\Logo;

class CompanyController extends Controller {

  public function index(Request $request, Company $company) {
    try {
      $companies = $company->getCompanies($request->search);
      $search = $request->search;

      return view('admin.companies.index', compact('companies', 'search'));
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error loading companies');
    }
  }

  public function show(Request $request, Company $company) {
    try {
      $company = $company->getCompany($request->company_id);
      $employees = $company->getEmployees($request->search);

      if (isset($company) && isset($employees)) {
        $search = $request->search;

        return view('admin.companies.show', compact('company', 'employees', 'search'));
      } else {
        return redirect()->back()
          ->with('error', 'Error loading company');
      }

    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error loading company');
    }
  }

  public function showUpdateCompanyForm(Request $request, Company $company) {
    try {
      $company = $company->getCompany($request->company_id);

      if (isset($company)) {
        return view('admin.companies.edit', compact('company'));
      } else {
        return redirect()->back()
          ->with('error', 'Error loading company');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error loading company');
    }
  }

  public function showCreateCompanyForm() {
    return view('admin.companies.create');
  }

  public function create(CompanyRequest $request, Company $company, Logo $logo, Address $address) {
    try {
      $company = $company->createCompany($request);

      if (isset($company) && $company instanceof Company) {
        if ($request->hasFile('company_logo')) {
          $logo = $logo->saveLogo($company, $request->company_logo);

          if ($logo && $logo instanceof Logo) {
            $company->associateLogo($logo);
          }
        }

        $address = $address->saveAddress($request);

        if (isset($address) && $address instanceof Address) {
          $company->associateAddress($address);
        }

        return redirect()->route('user_admin.company.show', [ "company_id" => $company->id ])
          ->with('created', 'Company created successfully');
      } else {
        return redirect()->back()
          ->with('error', 'Error creating company');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error creating company');
    }
  }

  public function handleEdit(CompanyRequest $request, Company $company, Address $address, Logo $logo) {
    try {
      $company = $company->getCompany($request->company_id);

      if ($company) {
        $company->updateCompany($request, $company->id);

        if (isset($company->address)) {
          $address->updateAddress($request, $company->address->id);
        } else {
          $address = $address->saveAddress($request);

          if ($address && $address instanceof Address) {
            $company->associateAddress($address);
          }
        }

        if ($request->hasFile('company_logo')) {
          if (isset($company->logo)) {
            $logo->updateLogo($company, $request->company_logo);
          } else {
            $logo = $logo->saveLogo($company, $request->company_logo);

            if ($logo && $logo instanceof Logo) {
              $company->associateLogo($logo);
            }
          }
        }

        return redirect()->route('user_admin.company.show', [ "company_id" => $company->id ])
          ->with('updated', 'Company successfully updated');
      } else {
        return redirect()->back()
          ->with('error', 'Error updating company');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error updating company');
    }
  }

  public function handleDelete(Request $request, Company $company) {
    try {
      $company = $company->getCompany($request->company_id);

      if (isset($company)) {
        $isCompanyDeleted = $company->deleteCompany();

        if ($isCompanyDeleted) {
          return redirect()->route('user_admin.company.index')
            ->with('deleted', 'Company deleted successfully');
        } else {
          return redirect()->back()
            ->with('error', 'Error deleting company');
        }
      } else {
        return redirect()->back()
          ->with('error', 'Error deleting company');
      }
    } catch (\Throwable $th) {
      return redirect()->back()
        ->with('error', 'Error deleting company');
    }
  }
}
