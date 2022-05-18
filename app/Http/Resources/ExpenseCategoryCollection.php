<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCategoryCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'expenseCategory' => $this->collection,
            'expenseCategoryCount' => $this->count()
        ];
    }
}