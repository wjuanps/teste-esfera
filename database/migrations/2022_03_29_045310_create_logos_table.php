<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('logos', function (Blueprint $table) {
      $table->string('id', 40)->primary();
      $table->string('filename', 50);
      $table->decimal('filesize', 8, 2);
      $table->string('file_id', 100);
      $table->string('mime_type', 30);
      $table->string('extension', 8);

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
    Schema::dropIfExists('logos');
  }
}
