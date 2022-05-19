<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

class Income extends Model
{

    protected $table = 'incomes';

    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'incomecategory_id','payment_type_id','description','amount','income_date'
       
    ];
    public function incomeCategory(): belongsTo
    {
        return $this->belongsTo(ExpenseCategory::class,'incomecategory_id','id');
    }
    public function paymentType(): belongsTo
    {
        return $this->belongsTo(PaymentType::class,'payment_type_id','id');
    }

    public function getFiltered(array $filters): Collection
    {
        $income=$this->with('incomeCategory','paymentType')->get();
        return $income;
    }
}