<?php

namespace App\Http\Requests\Income;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'required|string',  
            'amount' => 'required',         
            'income_date' => 'nullable|date_format:Y-m-d',         
            'payment_type_id' => 'required',   
            'incomecategory_id' => 'required',         
      
       
        ];
    }
}