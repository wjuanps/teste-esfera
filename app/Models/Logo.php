<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class Logo extends Model {

  use HasFactory, HasUuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'filename',
    'filesize',
    'file_id',
    'mime_type',
    'extension'
  ];

  public function company() {
    return $this->belongsTo(Company::class);
  }
}
