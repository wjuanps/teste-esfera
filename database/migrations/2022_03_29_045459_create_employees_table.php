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
      $table->string('first_name');
      $table->string('last_name');
      $table->string('phone')->nullable();
      $table->string('email')->unique()->nullable();

      $table->string('company_id', 40);
      $table->foreign('company_id')
        ->references('id')
        ->on('companies')
        ->onDelete('cascade');

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
