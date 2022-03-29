<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class Address extends Model {

  use HasFactory, HasUuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'city',
    'state',
    'number',
    'street',
    'district',
    'zip_code',
    'complement',
  ];

  public function company() {
    return $this->belongsTo(Company::class);
  }

  public function employee() {
    return $this->belongsTo(Employee::class);
  }
}
