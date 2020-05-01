<?php

namespace App\Http\Requests;

use App\BusinessDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBusinessDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:business_details,id',
        ];

    }
}
