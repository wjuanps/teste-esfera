@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Employee') }}</div>

        <div class="card-body">
          <div class="col-md-12 mx-auto">
            @include('layouts.includes.alerts')

            <form id="form_create_employee" action="{{ Route('user_admin.employee.handle.edit', ['company_id' => $company->id, 'employee_id' => $employee->id]) }}" method="POST">
              @method('PUT')
              {{ csrf_field() }}

              <div class="row mb-3">
                <div class="col">
                  <label class="form-label" for="employee_first_name">Employee first name</label>
                  <input value="{{ old('employee_first_name') != null ? old('employee_first_name') : $employee->first_name }}" type="text" id="employee_first_name" name="employee_first_name" class="form-control {{ $errors->has('employee_first_name') ? 'is-invalid' : '' }}" placeholder="Employee first name" aria-label="Employee first name" />
                  <div class="invalid-feedback">
                    {{ $errors->first('employee_first_name') }}
                  </div>
                </div>

                <div class="col">
                  <label class="form-label" for="employee_last_name">Employee last name</label>
                  <input value="{{ old('employee_last_name') != null ? old('employee_last_name') : $employee->last_name }}" type="text" id="employee_last_name" name="employee_last_name" class="form-control {{ $errors->has('employee_last_name') ? 'is-invalid' : '' }}" placeholder="Employee last name" aria-label="Employee last name" />
                  <div class="invalid-feedback">
                    {{ $errors->first('employee_last_name') }}
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col">
                  <label class="form-label" for="employee_email">Employee email</label>
                  <input value="{{ old('employee_email') != null ? old('employee_email') : $employee->email }}" type="email" id="employee_email" name="employee_email" class="form-control {{ $errors->has('employee_email') ? 'is-invalid' : '' }}" placeholder="Employee email" aria-label="Employee email" />
                  <div class="invalid-feedback">
                    {{ $errors->first('employee_email') }}
                  </div>
                </div>

                <div class="col">
                  <label class="form-label" for="employee_phone">Employee phone</label>
                  <input value="{{ old('employee_phone') != null ? old('employee_phone') : $employee->phone }}" type="text" id="employee_phone" name="employee_phone" class="form-control phone {{ $errors->has('employee_phone') ? 'is-invalid' : '' }}" placeholder="Employee phone" aria-label="Employee phone" />
                  <div class="invalid-feedback">
                    {{ $errors->first('employee_phone') }}
                  </div>
                </div>
              </div>

              <div class="row mb-3 mt-4">
                <h5>Address</h5>
                <div class="col-md-4">
                  <label class="form-label" for="address_zipcode">Zipcode</label>
                  <input value="{{ old('address_zipcode') != null ? old('address_zipcode') : isset($employee->address) ? $employee->address->zip_code : '' }}" type="text" id="address_zipcode" name="address_zipcode" class="form-control zipcode {{ $errors->has('address_zipcode') ? 'is-invalid' : '' }}" placeholder="Employee address zipcode" aria-label="Employee address zipcode" />
                  <div class="invalid-feedback">
                    {{ $errors->first('address_zipcode') }}
                  </div>
                </div>

                <div class="col-md-5">
                  <label class="form-label" for="address_street">Street</label>
                  <input value="{{ old('address_street') != null ? old('address_street') : isset($employee->address) ? $employee->address->street : '' }}" type="text" id="address_street" name="address_street" class="form-control" placeholder="Employee address street" aria-label="Employee address street" />
                </div>

                <div class="col-md-3">
                  <label class="form-label" for="address_number">Number</label>
                  <input value="{{ old('address_number') != null ? old('address_number') : isset($employee->address) ? $employee->address->number : '' }}" type="text" id="address_number" name="address_number" class="form-control" placeholder="Employee address number" aria-label="Employee address number" />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-5">
                  <label class="form-label" for="address_district">District</label>
                  <input value="{{ old('address_district') != null ? old('address_district') : isset($employee->address) ? $employee->address->district : '' }}" type="text" id="address_district" name="address_district" class="form-control" placeholder="Employee address district" aria-label="Employee address district" />
                </div>

                <div class="col-md-5">
                  <label class="form-label" for="address_city">City</label>
                  <input value="{{ old('address_city') != null ? old('address_city') : isset($employee->address) ? $employee->address->city : '' }}" type="text" id="address_city" name="address_city" class="form-control" placeholder="Employee address city" aria-label="Employee address city" />
                </div>

                <div class="col-md-2">
                  <label class="form-label" for="address_state">State</label>
                  <input value="{{ old('address_state') != null ? old('address_state') : isset($employee->address) ? $employee->address->state : '' }}" type="text" id="address_state" name="address_state" class="form-control state" placeholder="Employee address state" aria-label="Employee address state" />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-12">
                  <label class="form-label" for="address_complement">Complement</label>
                  <input value="{{ old('address_complement') != null ? old('address_complement') : isset($employee->address) ? $employee->address->complement : '' }}" type="text" id="address_complement" name="address_complement" class="form-control" placeholder="Employee address complement" aria-label="Employee address complement" />
                </div>
              </div>

              <button type="submit" class="btn btn-success mb-3 mt-3">Update employee</button>
              <a href="{{ Route('user_admin.company.show', $company->id) }}" class="btn btn-primary mb-3 mt-3">Go Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
