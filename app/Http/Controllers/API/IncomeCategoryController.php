<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\IncomeCategory\IndexRequest;
use App\Http\Requests\IncomeCategory\StoreRequest;
use App\Http\Requests\IncomeCategory\UpdateRequest;
use App\Http\Requests\IncomeCategory\DestroyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Resources\IncomeCategoryCollection;
use App\Http\Resources\IncomeCategoryResource;


class IncomeCategoryController extends Controller {

    protected IncomeCategory $incomeCategory;

    public function __construct(IncomeCategory $incomeCategory)
    {
        $this->incomeCategory= $incomeCategory;
      
    }
   
    /**
     * List the  income category collection '
     * @return Application|IncomeCategoryCollection
     * @throws Exception
     */
     public function index(IndexRequest $request): IncomeCategoryCollection
    {
        return new IncomeCategoryCollection($this->incomeCategory->getFiltered($request->validated()));
    }

     /**
      * Store the  income category  collection '
     * @return Application|IncomeCategoryResource
     * @throws Exception
     */

    public function store(IncomeCategory $incomeCategory, StoreRequest $request):IncomeCategoryResource
    {
        $incomeCategory = $incomeCategory->create($request->validated());
        return (new IncomeCategoryResource($incomeCategory))    
             ->additional(['status' =>"true","statusCode"=>200]);

    }

  /**
     * Update the specified  income category resource .
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeCategory $incomeCategory, UpdateRequest $request): IncomeCategoryResource
    {
        $id     =   request('id');
        $income  =  $incomeCategory->find(request('id'))->update($request->validated());

        return (new IncomeCategoryResource($incomeCategory->find(request('id')))) 
                  ->additional(['status' =>"true","statusCode"=>200]);


    }
      /**
     * Delete the specified  income category  resource .
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(IncomeCategory $incomeCategory, DestroyRequest $request)
    {
        $id     =   request('id');
        $del=$incomeCategory->find($id)->delete();
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
