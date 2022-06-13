<?php

namespace App\Http\Requests;

use App\Rules\CheckSmsCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return Auth::guest();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'code' => ['required', 'size:4', new CheckSmsCode]
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'code' => preg_replace('/[^\d]/', '', $this->code)
    ]);
  }
}
