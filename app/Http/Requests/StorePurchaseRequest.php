<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StorePurchaseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => 'required|integer',
            'purchase_date' => 'required|string',
            'purchase_number' => 'required|string|max:50',
            'purchase_items.*.product_id' => 'nullable|integer|exists:products,id',
            'purchase_items.*.quantity' => 'nullable|numeric|min:1',
            'purchase_items.*.unit_cost' => 'nullable|numeric',
            'purchase_items.*.total' => 'nullable|numeric',
            'purchase_items.*.deleted' => 'nullable|boolean',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'purchase_number' => IdGenerator::generate([
                'table' => 'purchases',
                'field' => 'purchase_number',
                'length' => 9,
                'prefix' => 'PN-'
            ]),
        ]);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'purchase_items.*.product_id' => 'product',
            'purchase_items.*.quantity' => 'quantity',
            'purchase_items.*.unit_cost' => 'cost',
        ];
    }
}
