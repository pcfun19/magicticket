<?php

namespace App\Http\Requests;

use App\BusinessDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateBusinessDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'               => [
                'required'],
            'taxid'              => [
                'required'],
            'activities_details' => [
                'required'],
        ];

    }
}
