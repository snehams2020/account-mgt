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
    * List the  expense category collection '
    * @param  App\Http\Requests\Article\IndexRequest $request
    * @return App\Http\Resources\ExpenseCategoryCollection
     */
     public function index(IndexRequest $request): ExpenseCategoryCollection
    {
        return new ExpenseCategoryCollection($this->expenseCategory->getFiltered($request->validated()));
    }
    
      /**
    * Show the  expense category By Id '
    * @return Application|ExpenseCategoryResource
     * @throws Exception
     */

    public function show(ExpenseCategory $expenseCategory):ExpenseCategoryResource
    {
        
        return (new ExpenseCategoryResource($expenseCategory->find(request('id'))))       
        ->additional(['status' =>"true","statusCode"=>200]);


    }
     /**
    * Store the  expense category collection '
    * @return Application|ExpenseCategoryResource
     * @throws Exception
     */

    public function store(ExpenseCategory $expenseCategory, StoreRequest $request):ExpenseCategoryResource
    {
        $expenseCategory = $expenseCategory->create($request->validated());
        return (new ExpenseCategoryResource($expenseCategory))              
        ->additional(['status' =>"true","statusCode"=>200]);

    }

  /**
     * Update the  expense category collection '
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategory $expenseCategory, UpdateRequest $request): ExpenseCategoryResource
    {
        $id     =   request('id');
        $pay    =  $expenseCategory->where('id',$id)->update($request->validated());
        return (new ExpenseCategoryResource($expenseCategory->find($id)))       
        ->additional(['status' =>"true","statusCode"=>200]);
        ;
    }
      /**
     * Delete the specified expense category.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(ExpenseCategory $expenseCategory, DestroyRequest $request):JsonResponse
    {
        $id     =   request('id');

       $del= $expenseCategory->find($id)->delete();
        if ($del) {
            $response['status'] = true;
            $response['message'] = 'Success';
            $statusCode=200;
        } elseif (empty($del)) {
            $response['status'] = true;
            $response['message'] = 'Not Able to delete';
            $statusCode=200;
        }
        return response()->json($response, $statusCode);

    }
  
}
