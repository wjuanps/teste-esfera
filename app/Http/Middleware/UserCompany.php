<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCompany {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {
    if (!auth()->check()) {
      return redirect()->route('login');
    }

    if (auth()->user()->role == 'company') {
      return $next($request);
    } else {
      return redirect()->back()
        ->with('error', 'You do not have permission to access this area!');
    }
  }
}
