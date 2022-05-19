<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Database\Eloquent\Collection;

class BalanceSheetService
{
    protected Expense $expense;
    protected Income $income;

    public function __construct(Expense $expense, Income $income)
    {
        $this->expense = $expense;
        $this->income = $income;
    }

    public function balanceSheet(array $tags): array
    {
       
        $date=!empty($tags['date'])?$tags['date']:"";
        $expense= $this->expense->with('expenseCategory','paymentType')->orderBy('expense_date');
        $income= $this->income->with('incomeCategory','paymentType')->orderBy('income_date');

        if(!empty($date) && $date!=""){

            $expense= $expense->whereDate('expense_date',date('Y-m-d',strtotime($date)));
            $income= $income->whereDate('income_date',date('Y-m-d',strtotime($date)));

        }
        $expense= $expense->get();
        $income= $income->get();

        $data=[];
        $data1=[];
        if(!empty($expense)){
        foreach($expense as $key=>$exp){
            $data[$key]['date']=date('d-m-Y',strtotime($exp->expense_date));
            $data[$key]['category']=$exp->expenseCategory->name;
            $data[$key]['credit']=0;
            $data[$key]['debit']=$exp->amount;
            $data[$key]['paymentType']=$exp->paymentType->name;


        }
    }
        if(!empty($income)){
        foreach($income as $key=>$inc){
            $data1[$key]['date']=date('d-m-Y',strtotime($inc->income_date));
            $data1[$key]['category']=$inc->incomeCategory->name;
            $data1[$key]['debit']=0;
            $data1[$key]['credit']=$inc->amount;
            $data1[$key]['paymentType']=$inc->paymentType->name;


        }
    }
    $merge=array_merge($data, $data1);
    return($merge);
       
    }
}

