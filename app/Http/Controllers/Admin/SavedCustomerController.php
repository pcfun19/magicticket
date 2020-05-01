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
use Yajra\DataTables\Facades\DataTables;

class SavedCustomerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('saved_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SavedCustomer::with(['created_by'])->select(sprintf('%s.*', (new SavedCustomer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'saved_customer_show';
                $editGate      = 'saved_customer_edit';
                $deleteGate    = 'saved_customer_delete';
                $crudRoutePart = 'saved-customers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('provider', function ($row) {
                return $row->provider ? $row->provider : "";
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->editColumn('method_type', function ($row) {
                return $row->method_type ? $row->method_type : "";
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.savedCustomers.index');
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
