@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ $company->name }}</div>

        <div class="card-body">
          <div class="col-md-12 mx-auto">
            @include('layouts.includes.alerts')

            <div class="row">
              <div class="col-md-8">
                <div class="row mb-3">
                  <div class="col-md-2">
                    <span>Email:</span>
                  </div>

                  <div class="col-md-10">
                    <span>{{ $company->email }}</span>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-2">
                    <span>Site:</span>
                  </div>

                  <div class="col-md-10">
                    <span>{{ $company->site }}</span>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-2">
                    <span>Endereço:</span>
                  </div>

                  <div class="col-md-10">
                    <span>
                      @if (isset($company->address))
                        {{
                          $company->address->street . ', '  .
                          $company->address->number . ' - ' .
                          $company->address->city   . '/'   .
                          $company->address->state
                        }}
                      @endif
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                @if(isset($company->logo))
                  <img src="{{ asset('storage/' . $company->logo->patch) }}" alt="Company logo" class="img-fluid img-thumbnail rounded float-end" width="100" height="100" />
                @endif
              </div>
            </div>

            <div class="row justify-content-center mb-3">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">{{ __('Employees') }}</div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="{{ Route('user_admin.employee.new', $company->id) }}" class="btn btn-success mb-2">Create new employee</a>
                      </div>
                      <div class="col">
                        <form action="{{ Route('user_admin.company.show', $company->id) }}" method="get">
                          <div class="input-group mb-3">
                            <input value="{{ $search }}" type="text" name="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" />
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i data-feather="search"></i></button>
                          </div>
                        </form>
                      </div>
                    </div>

                    @if(isset($employees) && count($employees) > 0)
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead class="table-light">
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Email</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($employees as $employee)
                              <tr>
                                <th>{{ $employee->first_name . ' ' . $employee->last_name }}</th>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                  <a href="{{ Route('user_admin.employee.show', [ "company_id" => $company->id, "employee_id" => $employee->id ]) }}"type="button" class="btn btn-secondary btn-sm">Edit</a>
                                  <a type="button" data-modal-id="delete_employee" data-route="{{ Route('user_admin.employee.handle.delete', [ "company_id" => $company->id, "employee_id" => $employee->id ]) }}" class="btn btn-danger modal_trigger_button btn-sm">Delete</a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                          {!! $employees->links() !!}
                        </div>
                      </div>
                    @else
                      <h1 class="text-center mt-5 mb-5">{{ __('No registered employees') }}</h1>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <a href="{{ Route('user_admin.company.edit', $company->id) }}" class="btn btn-secondary mb-3 mt-3">Edit company</a>
            <a type="button" data-modal-id="delete_company" data-route="{{ Route('user_admin.company.handle.delete', $company->id) }}" class="btn btn-danger modal_trigger_button">Delete company</a>
            <a href="{{ Route('user_admin.company.index') }}" class="btn btn-primary mb-3 mt-3">Back to companies</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('layouts.includes.modal-delete-resource', [
  "modalId" => "delete_company",
  "resource" => "company"
])

@include('layouts.includes.modal-delete-resource', [
  "modalId" => "delete_employee",
  "resource" => "employee"
])

@endsection
