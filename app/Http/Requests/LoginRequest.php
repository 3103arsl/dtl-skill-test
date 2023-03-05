<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the TagRequest.
     *
     * @return array
     */
    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'email' => 'required|string|email',
                        'password' => 'required|string'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                    ];
                }
            default:
                break;
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() {
        return [
            'email.required' => 'Please provide Email.',
            'password.required' => 'Please provide Password.',
        ];
    }
}
