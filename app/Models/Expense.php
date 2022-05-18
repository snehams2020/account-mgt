<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

class Expense extends Model
{

    protected $table = 'expenses';

    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'expensecategory_id','payment_type_id','description','amount','expense_date'
       
    ];
    public function expenseCategory(): belongsTo
    {
        return $this->belongsTo(ExpenseCategory::class,'expensecategory_id','id');
    }
    public function paymentType(): belongsTo
    {
        return $this->belongsTo(PaymentType::class,'payment_type_id','id');
    }

    public function getFiltered(array $filters): Collection
    {
        $expenseCategory=$this->with('expenseCategory','paymentType')->get();
        return $expenseCategory;
    }
}