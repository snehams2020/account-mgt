<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomeCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'status' => true,
            'statusCode'=>200,
            'income' => $this->map(function ($item, $key) {
                return [
                    
                    'id' => $item->id,
                    'description' => $item->description,
                    'amount' => $item->amount ,
                    'income_date' => $item->income_date,
                    'created_at' => $item->created_at,
                    'incomeCategory' => !empty($item->incomeCategory)?$item->incomeCategory->name:"",
                    'paymentType' => !empty($item->paymentType)?$item->paymentType->name:"",
                   
                   
                ];
            }),
            'incomeCount' => $this->count()
        ];
    }
}