<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'expense_date' => 'nullable',         
            'payment_type_id' => 'sometimes',   
            'expensecategory_id' => 'sometimes',          
        ];
    }
}