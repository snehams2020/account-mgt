<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Expense\IndexRequest;
use App\Http\Requests\Expense\StoreRequest;
use App\Http\Requests\Expense\UpdateRequest;
use App\Http\Requests\Expense\DestroyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Resources\ExpenseCollection;
use App\Http\Resources\ExpenseResource;


class ExpenseController extends Controller {

    protected Expense $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
      
    }
   
    /**
     * @return Application|Collection
     * @throws Exception
     */
     public function index(IndexRequest $request): ExpenseCollection
    {
        return new ExpenseCollection($this->expense->getFiltered($request->validated()));
    }

     /**
     * @return Application|PaymentTypeResource
     * @throws Exception
     */

    public function store(Expense $expense, StoreRequest $request):ExpenseResource
    {
        $expense = $expense->create($request->validated());
        return (new ExpenseResource($expense))       
         ->additional(['status' =>"true","statusCode"=>200]);

    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Expense $expense, UpdateRequest $request): ExpenseResource
    {
        $id     =   request('id');
        $expen   =  $expense->find(request('id'))->update($request->validated());

        return (new ExpenseResource($expense->find(request('id'))))   
             ->additional(['status' =>"true","statusCode"=>200]);

    }
      /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Expense $expense, DestroyRequest $request)
    {
        $id     =   request('id');
        $del    =   $expense->find($id)->delete();
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
