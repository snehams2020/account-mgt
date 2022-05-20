<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BalanceSheetCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {

        return [
            'status' => true,
            'statusCode'=>200,
            'balanceSheet' => $this->collection,
            'balanceSheetCount' => $this->count()
        ];
    }
}