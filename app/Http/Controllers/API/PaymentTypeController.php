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
     * @param $permission
     * @return JsonResponse
     * @throws ValidationException
     */
    public function destroy($page):
        JsonResponse {
            abort_if(Gate::denies('department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            validator(request()->route()->parameters(), ['department' => 'required|string|max:10000', ])->validate();
            $deleted = Department::where('id', decrypt($page))->delete();
            if ($deleted) {
                session()->flash('success', trans('pages.department_deleted_successfully'));
                return response()->json(['success' => trans('pages.department_deleted_successfully'), 'status' => true]);
            } else {
                session()->flash('error', trans('common.failed_to_delete'));
                return response()->json(['error' => trans('common.failed_to_delete'), 'status' => false]);
            }
        }

    public function edit($id)
    {
        // abort_if(Gate::denies('department_edit') , Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = decrypt($id);

        $department = Department::find($id);
        $statuses = AppConstants::statuses();
        $languages = Language::active()->get();

        return view('admins.pages.department.edit',compact('department','statuses','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        // abort_if(Gate::denies('department_edit') , Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department = Department::findOrFail(decrypt($id));
        $inputData = $request->validated();
        if ($request->hasFile('image')) {
            $fileNameOnly = time()."-".Str::random(40);
            $extension = $inputData['image']->getClientOriginalExtension();
            $fileName = $fileNameOnly.'.'.$extension;
            Storage::disk('public')->delete('departments/image/'.$department->image);
            Storage::disk('public')->putFileAs('departments/image/',$inputData['image'],$fileName);
            $inputData['image'] = $fileName;
        }
        if ($request->hasFile('icon')) {
            $fileNameOnly = time()."-".Str::random(40);
            $extension = $inputData['icon']->getClientOriginalExtension();
            $fileName = $fileNameOnly.'.'.$extension;
            Storage::disk('public')->delete('departments/icon/'.$department->icon);
            Storage::disk('public')->putFileAs('departments/icon/',$inputData['icon'],$fileName);
            $inputData['icon'] = $fileName;
        }

        $dataUpdate = Department::where('id', $department->id)->update(Arr::only($inputData, [
            'status',
            'image',
            'icon',
        ]));

        $languages = Language::active()->get();
        $trans = [];
        foreach ($languages as $language) {
            $trans[] = [
                'language_id' => $language->id,
                'department_id' => $department->id,
                'title'         => $inputData['title'][$language->id],
                'description'   => $inputData['description'][$language->id],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DepartmentTrans::where('department_id', $department->id)->delete();
        $insertTrans = DepartmentTrans::insert($trans);

        if ($dataUpdate && $insertTrans) {
            return redirect()->route('admin.departments.index')->with('success','Department updated successfully');
        } else {
            return redirect()->route('admin.departments.edit', ['department' => encrypt($department->id)])->with('error',trans('common.failed_to_update'));
        }
    }

  
}
