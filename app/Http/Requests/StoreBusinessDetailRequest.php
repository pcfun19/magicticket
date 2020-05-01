<?php

namespace App\Http\Requests;

use App\BusinessDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBusinessDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('business_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'               => [
                'required'],
            'taxid'              => [
                'required'],
            'passport.*'         => [
                'required'],
            'documents.*'        => [
                'required'],
            'activities_details' => [
                'required'],
        ];

    }
}
