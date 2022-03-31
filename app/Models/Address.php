<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasUuid;
use Illuminate\Http\Request;
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

  public function saveAddress(Request $request) {
    $error = null;
    $address = null;
    DB::transaction(function () use ($request, &$error, &$address) {
      try {
        $address = $this->create([
          'city' => $request->address_city,
          'state' => $request->address_state,
          'number' => $request->address_number,
          'street' => $request->address_street,
          'district' => $request->address_district,
          'zip_code' => $request->address_zipcode,
          'complement' => $request->address_complement,
        ]);
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    return $address;
  }

  public function updateAddress(Request $request, $address_id) {
    $error = null;
    $address = null;
    DB::transaction(function () use ($request, &$error, &$address, $address_id) {
      try {
        $address = Address::where('id', $address_id)
          ->update([
            'city' => $request->address_city,
            'state' => $request->address_state,
            'number' => $request->address_number,
            'street' => $request->address_street,
            'district' => $request->address_district,
            'zip_code' => $request->address_zipcode,
            'complement' => $request->address_complement,
          ]
        );
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    return $address;
  }

  public function company() {
    return $this->belongsTo(Company::class);
  }

  public function employee() {
    return $this->belongsTo(Employee::class);
  }
}
