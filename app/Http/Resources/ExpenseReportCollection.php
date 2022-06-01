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
                  //  'id' => $this->id,

                    'description' => $item->description,
                    'amount' => $item->amount ,
                    'expense_date' => date('d-m-Y',strtotime($item->expense_date)),
                    'expenseCategory' => !empty($item->expenseCategory->name)?$item->expenseCategory->name:"",
                    'paymentType' => !empty($item->paymentType->name)?$item->paymentType->name:"",
                   
                   
                ];
            }),
            'expenseReportCount' => $this->count()
        ];
    }
}