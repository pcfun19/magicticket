<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSavedCustomerRequest;
use App\Http\Requests\UpdateSavedCustomerRequest;
use App\Http\Resources\Admin\SavedCustomerResource;
use App\SavedCustomer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavedCustomerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('saved_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SavedCustomerResource(SavedCustomer::with(['created_by'])->get());

    }

    public function store(StoreSavedCustomerRequest $request)
    {
        $savedCustomer = SavedCustomer::create($request->all());

        return (new SavedCustomerResource($savedCustomer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(SavedCustomer $savedCustomer)
    {
        abort_if(Gate::denies('saved_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SavedCustomerResource($savedCustomer->load(['created_by']));

    }

    public function update(UpdateSavedCustomerRequest $request, SavedCustomer $savedCustomer)
    {
        $savedCustomer->update($request->all());

        return (new SavedCustomerResource($savedCustomer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(SavedCustomer $savedCustomer)
    {
        abort_if(Gate::denies('saved_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savedCustomer->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
