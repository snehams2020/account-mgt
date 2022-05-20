<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use App\Models\Income;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Income\IndexRequest;
use App\Http\Requests\Income\StoreRequest;
use App\Http\Requests\Income\UpdateRequest;
use App\Http\Requests\Income\DestroyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Resources\IncomeCollection;
use App\Http\Resources\IncomeResource;


class IncomeController extends Controller {

    protected Income $income;

    public function __construct(Income $income)
    {
        $this->income = $income;
      
    }
   
    /**
     * @return Application|Collection
     * @throws Exception
     */
     public function index(IndexRequest $request): IncomeCollection
    {
        return new IncomeCollection($this->income->getFiltered($request->validated()));
    }

     /**
     * @return Application|PaymentTypeResource
     * @throws Exception
     */

    public function store(Income $income, StoreRequest $request):IncomeResource
    {
        $income = $income->create($request->validated());
        return (new IncomeResource($income))      
           ->additional(['status' =>"true","statusCode"=>200]);

    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Income $income, UpdateRequest $request): IncomeResource
    {
        $id     =   request('id');
        $incom   =  $income->find(request('id'))->update($request->validated());

        return (new IncomeResource($income->find(request('id'))))   
             ->additional(['status' =>"true","statusCode"=>200]);

    }
      /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Income $income, DestroyRequest $request)
    {
        $id     =   request('id');
        $del= $income->find($id)->delete();
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
