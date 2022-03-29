<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('adresses', function (Blueprint $table) {
      $table->string('id', 40)->primary();
      $table->string('city', 40)->nullable();
      $table->string('number', 8)->nullable();
      $table->string('street', 25)->nullable();
      $table->string('district', 15)->nullable();
      $table->string('zip_code', 10)->nullable();
      $table->string('complement', 30)->nullable();

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
    Schema::dropIfExists('adresses');
  }
}
