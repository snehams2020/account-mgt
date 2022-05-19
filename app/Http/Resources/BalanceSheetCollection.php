<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BalanceSheetCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {

        return [
            'balanceSheet' => $this->collection,
            'balanceSheetCount' => $this->count()
        ];
    }
}