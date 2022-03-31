@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @include('layouts.includes.alerts')

    <div class="col">
      <div class="card">
        <h5 class="card-header">Companies</h5>
        <div class="card-body">
          <h1 class="card-title">{{ count($companies) }}</h1>
          <h4 class="card-text">Registered {{ Str::of('company')->plural(count($companies)) }}</h4>
          <a href="{{ Route('user_admin.company.index') }}" class="btn btn-primary mt-3">Go to companies</a>
          <a href="{{ Route('user_admin.company.create') }}" class="btn btn-success mt-3">Go to creating new company</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <h5 class="card-header">Employees</h5>
        <div class="card-body">
          <h1 class="card-title">{{ count($employees) }}</h1>
          <h4 class="card-text">Registered {{ Str::of('employee')->plural(count($employees)) }}</h4>
          <a href="{{ Route('user_admin.employee.index') }}" class="btn btn-primary mt-3">Go to employees</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
