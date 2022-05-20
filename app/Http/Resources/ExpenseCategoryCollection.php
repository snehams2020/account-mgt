<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCategoryCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'status' => true,
            'statusCode'=>200,
            'expenseCategory' => $this->collection,
            'expenseCategoryCount' => $this->count()
        ];
    }
}