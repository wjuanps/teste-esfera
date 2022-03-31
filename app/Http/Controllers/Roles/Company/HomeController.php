<?php

namespace App\Http\Controllers\Roles\Company;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index() {
    return view('company.home');
  }
}
