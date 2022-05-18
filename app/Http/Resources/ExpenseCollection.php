<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'expense' => $this->map(function ($item, $key) {
                return [
                    'id' => $item->id,
                    'description' => $item->description,
                    'amount' => $item->amount ,
                    'expense_date' => $item->expense_date,
                    'created_at' => $item->created_at,
                    'expenseCategory' => $item->expenseCategory->name,
                    'paymentType' => $item->paymentType->name,
                   
                   
                ];
            }),
            'expenseCount' => $this->count()
        ];
    }
}