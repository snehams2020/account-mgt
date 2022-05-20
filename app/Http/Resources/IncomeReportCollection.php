<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomeReportCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'status' => true,
            'statusCode'=>200,
            'incomeReport' => $this->map(function ($item, $key) {
                return [
                   
                    'description' => $item->description,
                    'amount' => $item->amount ,
                    'income_date' => date('d-m-Y',strtotime($item->income_date)),
                    'incomeCategory' => $item->incomeCategory->name,
                    'paymentType' => $item->paymentType->name,
                   
                   
                ];
            }),
            'incomeReportCount' => $this->count()
        ];
    }
}