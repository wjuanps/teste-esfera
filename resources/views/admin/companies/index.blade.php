@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Companies') }}</div>

        <div class="card-body">
          <div class="col-md-12 mx-auto">
            <div class="row">
              <div class="col">
                <a href="{{ Route('user_admin.company.new') }}" class="btn btn-success mb-2">Create new company</a>
              </div>
              <div class="col">
                <form action="{{ Route('user_admin.company.index') }}" method="get">
                  <div class="input-group mb-3">
                    <input value="{{ $search }}" type="text" name="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" />
                    <button class="btn btn-primary" type="submit" id="button-addon2"><i data-feather="search"></i></button>
                  </div>
                </form>
              </div>
            </div>

            @include('layouts.includes.alerts')

            @if (isset($companies) && count($companies) > 0)
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="table-light">
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Website</th>
                      <th scope="col">Email</th>
                      <th scope="col">Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($companies as $company)
                      <tr>
                        <th>{{ $company->name }}</th>
                        <td>
                          @if(isset($company->address))
                            {{
                              $company->address->street . ', '  .
                              $company->address->number . ' - ' .
                              $company->address->city   . '/'   .
                              $company->address->state
                            }}
                          @endif
                        </td>
                        <td>{{ $company->site }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                          <a href="{{ Route('user_admin.company.show', $company->id) }}"type="button" class="btn btn-secondary btn-sm">Details</a>
                          <a href="{{ Route('user_admin.company.edit', $company->id) }}"type="button" class="btn btn-secondary btn-sm">Edit</a>
                          <button type="button" data-modal-id="delete_company" data-route="{{ Route('user_admin.company.handle.delete', $company->id) }}" class="btn btn-danger modal_trigger_button btn-sm">Delete</button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="d-flex justify-content-center">
                  {!! $companies->links() !!}
                </div>
              </div>
            @else
              <h1 class="text-center mt-5 mb-5">{{ __('No registered companies') }}</h1>
            @endif
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

@endsection
