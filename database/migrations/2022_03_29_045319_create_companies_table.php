<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('companies', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('site')->nullable();

      $table->string('logo_id', 40)->nullable();
      $table->foreign('logo_id')->references('id')->on('logos');

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
    Schema::dropIfExists('companies');
  }
}
