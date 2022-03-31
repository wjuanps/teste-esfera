<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest {
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
      'company_name'  => [ 'required', 'min:3' ],
      'company_email' => [
        'required',
        'email' => Rule::unique('companies', 'email')->ignore($this->company_id, 'id'),
        'regex:/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'
      ],

      'company_logo'  => [ 'nullable', 'mimes:jpeg,jpg,png', 'dimensions:min_width=100,min_height=100' ],
      'company_site'  => [ 'nullable', 'regex:/^(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})$/' ],

      'address_zipcode' => [ 'nullable', 'regex:/^[0-9]{5}\-?[0-9]{3}$/' ]
    ];
  }

  public function messages() {
    return [
      'company_name.required'   => 'The Company name is required',
      'company_name.string'     => 'Please, provide a valid company name.',
      'company_name.min'        => 'Please, provide a valid company name.',

      'company_email.required'  => 'The Company email is required',
      'company_email.regex'     => 'Please, provide a valid company email.',

      'company_logo.dimensions' => 'Minimum dimensions for logo are 100 x 100',
      'company_logo.mimes'      => 'Invalid format. Allowed formats are jpeg, jpg and png',

      'company_site.regex'      => 'Please, provide a valid company site.',

      'address_zipcode.regex'      => 'Please, provide a valid address zipcode.',
    ];
  }
}
