<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'employee_first_name'  => [ 'required', 'min:3' ],
      'employee_last_name'  => [ 'required', 'min:3' ],
      'employee_email' => [
        'required',
        'email' => Rule::unique('employees', 'email')->ignore($this->employee_id, 'id'),
        'regex:/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'
      ],

      'employee_phone'  => [ 'nullable', 'regex:/^\([1-9]{2}\)\s9?[0-9]{4}\-[0-9]{4}$/' ],
      'address_zipcode' => [ 'nullable', 'regex:/^[0-9]{5}\-?[0-9]{3}$/' ]
    ];
  }

  public function messages() {
    return [
      'employee_first_name.required'   => 'The employee first name is required',
      'employee_first_name.string'     => 'Please, provide a valid employee first name.',
      'employee_first_name.min'        => 'Please, provide a valid employee first name.',

      'employee_last_name.required'   => 'The employee last name is required',
      'employee_last_name.string'     => 'Please, provide a valid employee last name.',
      'employee_last_name.min'        => 'Please, provide a valid employee last name.',

      'employee_email.required'  => 'The employee email is required',
      'employee_email.regex'     => 'Please, provide a valid employee email.',

      'employee_phone.regex'      => 'Please, provide a valid employee phone.',
      'address_zipcode.regex'      => 'Please, provide a valid address zipcode.',
    ];
  }
}
