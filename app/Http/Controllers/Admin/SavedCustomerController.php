<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySavedCustomerRequest;
use App\Http\Requests\StoreSavedCustomerRequest;
use App\Http\Requests\UpdateSavedCustomerRequest;
use App\SavedCustomer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavedCustomerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('saved_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savedCustomers = SavedCustomer::all();

        return view('admin.savedCustomers.index', compact('savedCustomers'));
    }

    public function create()
    {
        abort_if(Gate::denies('saved_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.savedCustomers.create');
    }

    public function store(StoreSavedCustomerRequest $request)
    {
        $savedCustomer = SavedCustomer::create($request->all());

        return redirect()->route('admin.saved-customers.index');

    }

    public function edit(SavedCustomer $savedCustomer)
    {
        abort_if(Gate::denies('saved_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savedCustomer->load('created_by');

        return view('admin.savedCustomers.edit', compact('savedCustomer'));
    }

    public function update(UpdateSavedCustomerRequest $request, SavedCustomer $savedCustomer)
    {
        $savedCustomer->update($request->all());

        return redirect()->route('admin.saved-customers.index');

    }

    public function show(SavedCustomer $savedCustomer)
    {
        abort_if(Gate::denies('saved_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savedCustomer->load('created_by', 'methodPayments');

        return view('admin.savedCustomers.show', compact('savedCustomer'));
    }

    public function destroy(SavedCustomer $savedCustomer)
    {
        abort_if(Gate::denies('saved_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $savedCustomer->delete();

        return back();

    }

    public function massDestroy(MassDestroySavedCustomerRequest $request)
    {
        SavedCustomer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
