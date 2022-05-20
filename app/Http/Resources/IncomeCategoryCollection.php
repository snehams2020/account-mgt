<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomeCategoryCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'status' => true,
            'statusCode'=>200,
            'incomeCategory' => $this->collection,
            'incomeCategoryCount' => $this->count()
        ];
    }
}