<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PaymentType\IndexRequest;
use App\Http\Requests\PaymentType\StoreRequest;
use App\Http\Requests\PaymentType\UpdateRequest;
use App\Http\Requests\PaymentType\DestroyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Resources\PaymentTypeCollection;
use App\Http\Resources\PaymentTypeResource;


class PaymentTypeController extends Controller {

    protected PaymentType $paymentType;

    public function __construct(PaymentType $paymentType)
    {
        $this->paymentType = $paymentType;
      
    }
   
    /**
     * @return Application|Collection
     * @throws Exception
     */
     public function getPaymentType(IndexRequest $request): PaymentTypeCollection
    {
        return new PaymentTypeCollection($this->paymentType->getFiltered($request->validated()));
    }

     /**
     * @return Application|PaymentTypeResource
     * @throws Exception
     */

    public function store(PaymentType $payment, StoreRequest $request):PaymentTypeResource
    {
        $paymentTypes =$payment->create($request->validated());
        return new PaymentTypeResource($paymentTypes);
    }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentType $payment, UpdateRequest $request): PaymentTypeResource
    {
        $id=request('id');
        $pay =  $payment->find(request('id'))->update($request->validated());
        return new PaymentTypeResource($payment->find( $id));
    }
      /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(PaymentType $payment, DestroyRequest $request): void
    {
        $id=request('id');

        $payment->find($id)->delete();
    }
  
}
