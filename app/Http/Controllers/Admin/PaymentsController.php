<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Payment;
use App\SavedCustomer;
use App\Ticket;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Payment::with(['ticket', 'method', 'affiliate_user', 'created_by'])->select(sprintf('%s.*', (new Payment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'payment_show';
                $editGate      = 'payment_edit';
                $deleteGate    = 'payment_delete';
                $crudRoutePart = 'payments';

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
            $table->addColumn('ticket_name', function ($row) {
                return $row->ticket ? $row->ticket->name : '';
            });

            $table->editColumn('ticket.price', function ($row) {
                return $row->ticket ? (is_string($row->ticket) ? $row->ticket : $row->ticket->price) : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Payment::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('method_method_type', function ($row) {
                return $row->method ? $row->method->method_type : '';
            });

            $table->editColumn('method.slug', function ($row) {
                return $row->method ? (is_string($row->method) ? $row->method : $row->method->slug) : '';
            });
            $table->addColumn('affiliate_user_business_name', function ($row) {
                return $row->affiliate_user ? $row->affiliate_user->business_name : '';
            });


            $table->rawColumns(['actions', 'placeholder', 'ticket', 'method', 'affiliate_user']);

            return $table->make(true);
        }

        return view('admin.payments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = Ticket::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $methods = SavedCustomer::all()->pluck('method_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliate_users = User::all()->pluck('business_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payments.create', compact('tickets', 'methods', 'affiliate_users', 'created_bies'));
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->all());

        return redirect()->route('admin.payments.index');

    }

    public function edit(Payment $payment)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = Ticket::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $methods = SavedCustomer::all()->pluck('method_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliate_users = User::all()->pluck('business_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment->load('ticket', 'method', 'affiliate_user', 'created_by');

        return view('admin.payments.edit', compact('tickets', 'methods', 'affiliate_users', 'created_bies', 'payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('admin.payments.index');

    }

    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('ticket', 'method', 'affiliate_user', 'created_by');

        return view('admin.payments.show', compact('payment'));
    }

    public function destroy(Payment $payment)
    {
        abort_if(Gate::denies('payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->delete();

        return back();

    }

    public function massDestroy(MassDestroyPaymentRequest $request)
    {
        Payment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
