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
use App\Http\Resources\BalanceSheetCollection;
use App\Models\Income;
use App\Services\BalanceSheetService;
class ReportController extends Controller {

    protected Expense $expense;
    protected Income $income;
    protected BalanceSheetService $balanceSheetService;

    public function __construct(Expense $expense,Income $income,BalanceSheetService $balanceSheetService)
    {
        $this->expense = $expense;
        $this->income = $income;
        $this->balanceSheetService = $balanceSheetService;      
    }
   
    /**
     * List the expense report
     * @return Application|ExpenseReportCollection
     * @throws Exception
     */
    public function getExpenseReport(Request $request): ExpenseReportCollection
    {
     return new ExpenseReportCollection($this->expense->getFilteredExpenseReport((array)request()->all()));
    }

   /**
    * List the income report
     * @return Application|IncomeReportCollection
     * @throws Exception
     */
    public function getIncomeReport(Request $request): IncomeReportCollection
    {
     return new IncomeReportCollection($this->income->getFilteredIncomeReport((array)request()->all()));
    }
    /**
     * List the balance sheet
     * @return Application|BalanceSheetCollection
     * @throws Exception
     */
    public function getBalanceSheet(Request $request): BalanceSheetCollection
    {
     return new BalanceSheetCollection($this->balanceSheetService->balanceSheet((array)request()->all()));
    }
  
}
