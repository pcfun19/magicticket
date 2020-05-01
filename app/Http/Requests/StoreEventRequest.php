<?php

namespace App\Http\Requests;

use App\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreEventRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'cover'             => [
                'required'],
            'name'              => [
                'required'],
            'is_online'         => [
                'required'],
            'address'           => [
                'required'],
            'organiser_details' => [
                'required'],
            'slug'              => [
                'required',
                'unique:events'],
        ];

    }
}
