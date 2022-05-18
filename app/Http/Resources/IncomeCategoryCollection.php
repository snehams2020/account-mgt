<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomeCategoryCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'incomeCategory' => $this->collection,
            'incomeCategoryCount' => $this->count()
        ];
    }
}