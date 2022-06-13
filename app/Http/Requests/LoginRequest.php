<?php

namespace App\Http\Requests;

// use App\Rules\CheckAge;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::guest();
    }

    public function rules()
    {
        return [
            'phone' => ['required'],
            // 'uin' => ['required', 'size:12', new CheckAge],
            'pass' => ['required'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/[^\d+]/', '', $this->phone),
            // 'uin' => preg_replace('/[^\d]/', '', $this->uin),
            'pass' => preg_replace('/[^\d]/', '', $this->pass)

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
