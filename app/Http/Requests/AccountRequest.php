<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => [
                function ($attribute, $value, $fail) {
                    if ((preg_match('/\s/', $value))) {
                        return $fail($attribute . ' không được có khoảng trắng');
                    }
                },

                function ($attribute, $value, $fail) {
                    if (strtolower($value) !== $value) {
                        return $fail($attribute . ' không được viết hoa');
                    }
                },
            ]
        ];
    }
}
