<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::factory()
      ->count(3)
      ->state(new Sequence(
        ["name" => "User admin teste", "role" => "admin", "email" => "admin@admin.com"],
        ["name" => "User company teste", "role" => "company", "email" => "company@company.com"],
        ["name" => "User employee teste", "role" => "employee", "email" => "employee@employee.com"],
      ))
      ->create();
  }
}
