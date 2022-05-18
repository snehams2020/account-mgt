<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public static $wrap = 'expense';

    public function toArray($request): array
    {
        return [
            'expensecategory_id' => $this->expensecategory_id,
            'payment_type_id' => $this->payment_type_id,
            'description' => $this->description,
            'amount' => $this->amount,
            'expense_date' => date('Y-m-d',strtotime($this->expense_date)),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
           
           
        ];
    }
}

