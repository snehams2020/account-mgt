<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomeCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'income' => $this->map(function ($item, $key) {
                return [
                    'id' => $item->id,
                    'description' => $item->description,
                    'amount' => $item->amount ,
                    'income_date' => $item->income_date,
                    'created_at' => $item->created_at,
                    'incomeCategory' => $item->incomeCategory->name,
                    'paymentType' => $item->paymentType->name,
                   
                   
                ];
            }),
            'incomeCount' => $this->count()
        ];
    }
}