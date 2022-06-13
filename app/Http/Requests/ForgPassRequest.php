<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForgPassRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::guest();
    }

    public function rules()
    {
        return [
            'phone' => ['required']

        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/[^\d+]/', '', $this->phone),
        ]);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'uin' => trans('Сервис временно не достуен, попробуйте зайти позже'),
        ];
    }
}
