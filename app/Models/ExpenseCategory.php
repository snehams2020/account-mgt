<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

class ExpenseCategory extends Model
{

    protected $table = 'expense_categories';

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
        $expenseCategory=$this->get();
        return $expenseCategory;
    }
}