<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseCategoryResource extends JsonResource
{
    public static $wrap = 'expenseCategory';

    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
           
            // 'author' => [
            //     'username' => $this->user->username,
            //     'bio' => $this->user->bio,
            //     'image' => $this->user->image,
            //     'following' => $this->user->followers->contains(auth()->id())
            // ]
        ];
    }
}

