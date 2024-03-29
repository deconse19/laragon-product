<?php

namespace App\Http\Requests\CompanyRequest;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'company_id'=>'required|numeric',
           'product_id' => 'required|array',
           'product_id.*' => 'distinct'
          
        ];
    }
}
