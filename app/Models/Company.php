<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class Company extends Model {

  use HasFactory, HasUuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'site',
  ];

  public function logo() {
    return $this->hasOne(Logo::class);
  }

  public function address() {
    return $this->hasOne(Address::class);
  }
}
