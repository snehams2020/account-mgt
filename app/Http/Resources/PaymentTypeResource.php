<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTypeResource extends JsonResource
{
    //public static $status =   "Success";
    //public static $statuscode =   200;
    public static $wrap = 'paymentType';

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

