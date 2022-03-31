<?php

namespace App\Http\Controllers\Roles\Employee;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

  public function index() {
    return view('employee.home');
  }
}
