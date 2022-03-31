<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index() {
    switch (auth()->user()->role) {
      case 'admin':
        return $this->adminHome();
        break;
      case 'company':
        return $this->companyHome();
        break;
      case 'employee':
        return $this->employeeHome();
        break;
      default:
        return redirect()->route('login');
        break;
    }
  }

  private function adminHome() {
    return redirect()
      ->route('user_admin.home');
  }

  private function companyHome() {
    return redirect()
      ->route('user_company.home');
  }

  private function employeeHome() {
    return redirect()
      ->route('user_employee.home');
  }
}
