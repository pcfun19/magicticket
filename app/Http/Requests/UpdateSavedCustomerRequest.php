<?php

namespace App\Http\Requests;

use App\SavedCustomer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSavedCustomerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('saved_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'provider' => [
                'required'],
            'code'     => [
                'required'],
        ];

    }
}
