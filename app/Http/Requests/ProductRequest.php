<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{

    protected $table = 'products';

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
     * Get the validation rules that apply to the TagRequest.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => ['required', 'unique:' . $this->table],
                    'type' => ['required', Rule::in([Product::TYPE_PRODUCT, Product::TYPE_SERVICE])],
                    'price' => ['required', 'numeric'],
                    'status' => ['required', Rule::in([Product::STATUS_ACTIVE, Product::STATUS_INACTIVE])]
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => ['required'],
                    'type' => ['required', Rule::in([Product::TYPE_PRODUCT, Product::TYPE_SERVICE])],
                    'price' => ['required', 'numeric'],
                    'status' => ['required', Rule::in([Product::STATUS_ACTIVE, Product::STATUS_INACTIVE])]
                ];
            }
            default:
                break;
        }
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ]));

    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'type.required' => 'The type field is required.',
            'price.required' => 'The price field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
