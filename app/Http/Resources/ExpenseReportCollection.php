<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseReportCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'status' => true,
            'statusCode'=>200,
            'expenseReport' => $this->map(function ($item, $key) {
                return [
                   
                    'description' => $item->description,
                    'amount' => $item->amount ,
                    'expense_date' => date('d-m-Y',strtotime($item->expense_date)),
                    'expenseCategory' => $item->expenseCategory->name,
                    'paymentType' => $item->paymentType->name,
                   
                   
                ];
            }),
            'expenseReportCount' => $this->count()
        ];
    }
}