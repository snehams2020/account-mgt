<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncomeCategoryResource extends JsonResource
{
    public static $wrap = 'incomeCategory';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
           
           
        ];
    }
}

