<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
class PaymentType extends Model
{

    protected $table = 'payment_types';

    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
       
    ];
    public function getFiltered(array $filters): Collection
    {
        $paymentType=$this->get();
        return $paymentType;
    }
}