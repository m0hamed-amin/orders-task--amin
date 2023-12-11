<?php

namespace App\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
        ];
    }
}
