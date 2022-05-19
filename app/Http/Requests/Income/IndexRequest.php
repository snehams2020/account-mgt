<?php

namespace App\Http\Requests\Income;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'sometimes|string',  
            'amount' => 'sometimes',         
            'income_date' => 'nullable',         
            'payment_type_id' => 'sometimes',   
            'incomecategory_id' => 'sometimes',   
        ];
    }
}