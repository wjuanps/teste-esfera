@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Edit company' . ' - ' . isset($company) ? $company->name : '' ) }}</div>

        <div class="card-body">
          <div class="col-md-12 mx-auto">
            @include('layouts.includes.alerts')

            @if(isset($company))
              <form id="form_create_company" action="{{ Route('user_admin.company.handle.edit', $company->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}

                <div class="row mb-3">
                  <div class="col">
                    <label class="form-label" for="company_name">Company name</label>
                    <input value="{{ old('company_name') != null ? old('company_name') : $company->name }}" type="text" id="company_name" name="company_name" class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" placeholder="Company name" aria-label="Company name" />
                    <div class="invalid-feedback">
                      {{ $errors->first('company_name') }}
                    </div>
                  </div>

                  <div class="col">
                    <label class="form-label" for="company_logo">Company logo</label>
                    <input value="{{ isset($company->logo) ? asset('storage/' . $company->logo->patch) : null }}" class="form-control {{ $errors->has('company_logo') ? 'is-invalid' : '' }}" type="file" id="company_logo" name="company_logo" placeholder="Company logo" aria-label="Company logo" />
                    <div class="invalid-feedback">
                      {{ $errors->first('company_logo') }}
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label class="form-label" for="company_email">Company email</label>
                    <input value="{{ old('company_email') != null ? old('company_email') : $company->email }}" type="email" id="company_email" name="company_email" class="form-control {{ $errors->has('company_email') ? 'is-invalid' : '' }}" placeholder="Company email" aria-label="Company email" />
                    <div class="invalid-feedback">
                      {{ $errors->first('company_email') }}
                    </div>
                  </div>

                  <div class="col">
                    <label class="form-label" for="company_site">Company site</label>
                    <input value="{{ old('company_site') != null ? old('company_site') : $company->site }}" type="text" id="company_site" name="company_site" class="form-control {{ $errors->has('company_site') ? 'is-invalid' : '' }}" placeholder="Company site" aria-label="Company site" />
                    <div class="invalid-feedback">
                      {{ $errors->first('company_site') }}
                    </div>
                  </div>
                </div>

                <div class="row mb-3 mt-4">
                  <h5>Address</h5>
                  <div class="col-md-4">
                    <label class="form-label" for="address_zipcode">Zipcode</label>
                    <input value="{{ old('address_zipcode') != null ? old('address_zipcode') : isset($company->address) ? $company->address->zip_code : '' }}" type="text" id="address_zipcode" name="address_zipcode" class="form-control zipcode {{ $errors->has('address_zipcode') ? 'is-invalid' : '' }}" placeholder="Company address zipcode" aria-label="Company address zipcode" />
                    <div class="invalid-feedback">
                      {{ $errors->first('address_zipcode') }}
                    </div>
                  </div>

                  <div class="col-md-5">
                    <label class="form-label" for="address_street">Street</label>
                    <input value="{{ old('address_street') != null ? old('address_street') : isset($company->address) ? $company->address->street : '' }}" type="text" id="address_street" name="address_street" class="form-control" placeholder="Company address street" aria-label="Company address street" />
                  </div>

                  <div class="col-md-3">
                    <label class="form-label" for="address_number">Number</label>
                    <input value="{{ old('address_number') != null ? old('address_number') : isset($company->address) ? $company->address->number : '' }}" type="text" id="address_number" name="address_number" class="form-control" placeholder="Company address number" aria-label="Company address number" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-5">
                    <label class="form-label" for="address_district">District</label>
                    <input value="{{ old('address_district') != null ? old('address_district') : isset($company->address) ? $company->address->district : '' }}" type="text" id="address_district" name="address_district" class="form-control" placeholder="Company address district" aria-label="Company address district" />
                  </div>

                  <div class="col-md-5">
                    <label class="form-label" for="address_city">City</label>
                    <input value="{{ old('address_city') != null ? old('address_city') : isset($company->address) ? $company->address->city : '' }}" type="text" id="address_city" name="address_city" class="form-control" placeholder="Company address city" aria-label="Company address city" />
                  </div>

                  <div class="col-md-2">
                    <label class="form-label" for="address_state">State</label>
                    <input value="{{ old('address_state') != null ? old('address_state') : isset($company->address) ? $company->address->state : '' }}" type="text" id="address_state" name="address_state" class="form-control state" placeholder="Company address state" aria-label="Company address state" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-12">
                    <label class="form-label" for="address_complement">Complement</label>
                    <input value="{{ old('address_complement') != null ? old('address_complement') : isset($company->address) ? $company->address->complement : '' }}" type="text" id="address_complement" name="address_complement" class="form-control" placeholder="Company address complement" aria-label="Company address complement" />
                  </div>
                </div>

                <button type="submit" class="btn btn-success mb-3 mt-3">Update company</button>
                <a href="{{ Route('user_admin.company.show', $company->id) }}" class="btn btn-primary mb-3 mt-3">Back to company</a>
              </form>
            @else
              <h1>{{ __('Error loading company') }}</h1>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
