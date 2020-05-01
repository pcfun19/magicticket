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

class PaymentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payments = Payment::all();

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = Ticket::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $methods = SavedCustomer::all()->pluck('method_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affiliate_users = User::all()->pluck('business_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payments.create', compact('tickets', 'methods', 'affiliate_users'));
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

        $payment->load('ticket', 'method', 'affiliate_user', 'created_by');

        return view('admin.payments.edit', compact('tickets', 'methods', 'affiliate_users', 'payment'));
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
