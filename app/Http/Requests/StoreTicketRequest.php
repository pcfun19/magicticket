<?php

namespace App\Http\Requests;

use App\Ticket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTicketRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'            => [
                'required'],
            'total_available' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'price'           => [
                'required',
                'integer',
                'min:5',
                'min:500'],
            'currency'        => [
                'required'],
            'includes'        => [
                'required'],
            'ticket_image'    => [
                'required'],
            'top_margin'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'left_margin'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'font_size'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'font_angle'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
