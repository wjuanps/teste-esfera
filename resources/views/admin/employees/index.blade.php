@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Employees') }}</div>

        <div class="card-body">
          <div class="col-md-12">
            <div class="row">
              <div class="col">
              </div>
              <div class="col">
                <form action="{{ Route('user_admin.employee.index') }}" method="get">
                  <div class="input-group mb-3">
                    <input value="{{ $search }}" type="text" name="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" />
                    <button class="btn btn-primary" type="submit" id="button-addon2"><i data-feather="search"></i></button>
                  </div>
                </form>
              </div>
            </div>

            @include('layouts.includes.alerts')

            @if(isset($employees) && count($employees) > 0)
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="table-light">
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Email</th>
                      <th scope="col">Company</th>
                      <th scope="col">Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($employees as $employee)
                      <tr>
                        <th>{{ $employee->full_name }}</th>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                          <a href="{{ Route('user_admin.company.show', $employee->company_id) }}" style="text-decoration: none">
                            {{ $employee->company_name }}
                          </a>
                        </td>
                        <td>
                          <a href="{{ Route('user_admin.employee.show', [ "company_id" => $employee->company_id, "employee_id" => $employee->id ]) }}"type="button" class="btn btn-secondary">Edit</a>
                          <a type="button" data-modal-id="delete_employee" data-route="{{ Route('user_admin.employee.handle.delete', [ "company_id" => $employee->company_id, "employee_id" => $employee->id ]) }}" class="btn btn-danger modal_trigger_button">Delete</a>
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
  </div>
</div>

@include('layouts.includes.modal-delete-resource', [
  "modalId" => "delete_employee",
  "resource" => "employee"
])

@endsection
