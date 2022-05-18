<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ExpenseCategory\IndexRequest;
use App\Http\Requests\ExpenseCategory\StoreRequest;
use App\Http\Requests\ExpenseCategory\UpdateRequest;
use App\Http\Requests\ExpenseCategory\DestroyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Resources\ExpenseCategoryCollection;
use App\Http\Resources\ExpenseCategoryResource;


class ExpenseCategoryController extends Controller {

    protected ExpenseCategory $expenseCategory;

    public function __construct(ExpenseCategory $expenseCategory)
    {
        $this->expenseCategory = $expenseCategory;
      
    }
   
    /**
     * @return Application|Collection
     * @throws Exception
     */
     public function index(IndexRequest $request): ExpenseCategoryCollection
    {
        return new ExpenseCategoryCollection($this->expenseCategory->getFiltered($request->validated()));
    }

     /**
     * @return Application|PaymentTypeResource
     * @throws Exception
     */

    public function store(ExpenseCategory $expenseCategory, StoreRequest $request):ExpenseCategoryResource
    {
        $expenseCategory = $expenseCategory->create($request->validated());
        return new ExpenseCategoryResource($expenseCategory);
    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategory $expenseCategory, UpdateRequest $request): ExpenseCategoryResource
    {
        $id     =   request('id');
        $pay    =  $expenseCategory->find(request('id'))->update($request->validated());
        return new ExpenseCategoryResource($expenseCategory->find( $id));
    }
      /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(ExpenseCategory $expenseCategory, DestroyRequest $request): void
    {
        $id     =   request('id');

        $expenseCategory->find($id)->delete();
    }
  
}
