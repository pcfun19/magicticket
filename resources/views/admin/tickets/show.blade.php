@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ticket.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-primary" href="{{ route('admin.tickets.edit',$ticket->id) }}">
                    {{ trans('global.edit') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.uuid') }}
                        </th>
                        <td>
                            {{ $ticket->uuid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.event') }}
                        </th>
                        <td>
                            {{ $ticket->event->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.name') }}
                        </th>
                        <td>
                            {{ $ticket->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.total_available') }}
                        </th>
                        <td>
                            {{ $ticket->total_available }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.price') }}
                        </th>
                        <td>
                            {{ $ticket->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.currency') }}
                        </th>
                        <td>
                            {{ App\Ticket::CURRENCY_SELECT[$ticket->currency] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.includes') }}
                        </th>
                        <td>
                            {{ $ticket->includes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.instructions') }}
                        </th>
                        <td>
                            {{ $ticket->instructions }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.ticket_image') }}
                        </th>
                        <td>
                            @if($ticket->ticket_sample)
                                    <img src="{{ $ticket->ticket_sample->url }}" class="responsive">
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#ticket_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ticket_payments">
            @includeIf('admin.tickets.relationships.ticketPayments', ['payments' => $ticket->ticketPayments])
        </div>
    </div>
</div>

@endsection