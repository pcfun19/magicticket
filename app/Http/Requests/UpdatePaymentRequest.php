<?php

namespace App\Http\Requests;

use App\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'uuid'              => [
                'required'],
            'ticket_id'         => [
                'required',
                'integer'],
            'status'            => [
                'required'],
            'method_id'         => [
                'required',
                'integer'],
            'refunded_at'       => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
            'affiliate_user_id' => [
                'required',
                'integer'],
        ];

    }
}
