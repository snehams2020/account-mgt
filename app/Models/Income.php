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
        return $this->belongsTo(IncomeCategory::class,'incomecategory_id','id');
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
    public function getFilteredIncomeReport(array $filters): Collection
    {
        $incomeDate=!empty($filters['income_date'])?$filters['income_date']:"";
        $category=!empty($filters['category'])?$filters['category']:"";
        $paymentType=!empty($filters['payment_type'])?$filters['payment_type']:"";
       
        $income=$this->with('incomeCategory','paymentType');

        if(!empty($category) && $category!=""){
            $income=$income->whereHas('incomeCategory', function($q) use ($category){
                $q->where('name','like',$category);
                $q->orWhere('id',$category);

            });
        }
        if(!empty($paymentType) && $paymentType!=""){

            $income=$income->whereHas('paymentType', function($q) use ($paymentType){
                $q->where('name','like',$paymentType);
                $q->orWhere('id',$paymentType);

            });
        }
        if(!empty($incomeDate) && $incomeDate!=""){
            $income=$income->whereDate('income_date',date('Y-m-d',strtotime($incomeDate)));

        }
        $income=$income->get();
      
        return $income;
    }
}