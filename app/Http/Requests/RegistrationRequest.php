<?php

namespace App\Http\Requests;

use App\Rules\CheckAge;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegistrationRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Auth::guest();
    // }

    public function rules()
    {
        return [
            'phone' => ['required'],
            'uin' => ['required', 'size:12', new CheckAge],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/[^\d+]/', '', $this->phone),
            'uin' => preg_replace('/[^\d]/', '', $this->uin)
        ]);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function message()
    {
        return trans('Сервис временно не достуен, попробуйте зайти позже');
    }
}
