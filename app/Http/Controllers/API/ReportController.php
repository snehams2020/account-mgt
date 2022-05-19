<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Resources\ExpenseReportCollection;
use App\Http\Resources\IncomeReportCollection;
use App\Models\Income;

class ReportController extends Controller {

    protected Expense $expense;

    public function __construct(Expense $expense,Income $income)
    {
        $this->expense = $expense;
        $this->income = $income;

      
    }
   
    /**
     * @return Application|Collection
     * @throws Exception
     */
    public function getExpenseReport(Request $request): ExpenseReportCollection
    {
     return new ExpenseReportCollection($this->expense->getFilteredExpenseReport((array)request()->all()));
    }

   /**
     * @return Application|Collection
     * @throws Exception
     */
    public function getIncomeReport(Request $request): IncomeReportCollection
    {
     return new IncomeReportCollection($this->income->getFilteredIncomeReport((array)request()->all()));
    }
  
}
