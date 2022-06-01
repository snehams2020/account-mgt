<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
{
    public static $wrap = 'income';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,

            'incomecategory_id' => $this->incomecategory_id,
            'payment_type_id' => $this->payment_type_id,
            'description' => $this->description,
            'amount' => $this->amount,
            'income_date' => date('Y-m-d',strtotime($this->income_date)),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
           
           
        ];
    }
}

