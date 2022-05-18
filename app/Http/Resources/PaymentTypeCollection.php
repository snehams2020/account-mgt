<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentTypeCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'paymentType' => $this->collection,
            'paymentTypeCount' => $this->count()
        ];
    }
}