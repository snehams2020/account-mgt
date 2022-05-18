<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'expensecategory_id','payment_type_id','description','amount','expense_date','expensecategory_id'
       
    ];
    public function getFiltered(array $filters): Collection
    {
        $expenseCategory=$this->get();
        return $expenseCategory;
    }
}