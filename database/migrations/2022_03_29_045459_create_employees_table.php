<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('employees', function (Blueprint $table) {
      $table->string('id', 40)->primary();
      $table->string('name');
      $table->string('last_name');
      $table->string('phone');
      $table->string('email')->unique();

      $table->string('company_id', 40);
      $table->foreign('company_id')->references('id')->on('companies');

      $table->string('address_id', 40)->nullable();
      $table->foreign('address_id')->references('id')->on('adresses');

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('employees');
  }
}
