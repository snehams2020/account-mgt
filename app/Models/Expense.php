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
        $expense=$this->with('expenseCategory','paymentType')->get();
        return $expense;
    }
    public function getFilteredExpenseReport(array $filters): Collection
    {
        $expenseDate=!empty($filters['expense_date'])?$filters['expense_date']:"";
        $category=!empty($filters['category'])?$filters['category']:"";
        $paymentType=!empty($filters['payment_type'])?$filters['payment_type']:"";
       
        $expense=$this->with('expenseCategory','paymentType');

        if(!empty($category) && $category!=""){
            $expense=$expense->whereHas('expenseCategory', function($q) use ($category){
                $q->where('name','like',$category);
                $q->orWhere('id',$category);

            });
        }
        if(!empty($paymentType) && $paymentType!=""){

            $expense=$expense->whereHas('paymentType', function($q) use ($paymentType){
                $q->where('name','like',$paymentType);
                $q->orWhere('id',$paymentType);

            });
        }
        if(!empty($expenseDate) && $expenseDate!=""){
            $expense=$expense->whereDate('expense_date',date('Y-m-d',strtotime($expenseDate)));

        }
        $expense=$expense->get();
      
        return $expense;
    }
}