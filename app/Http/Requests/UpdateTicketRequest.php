<?php

namespace App\Http\Requests;

use App\Ticket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTicketRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'min:5'],
            'currency'        => [
                'required'],
            'includes'        => [
                'required'],
            'event_date'      => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')],
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
