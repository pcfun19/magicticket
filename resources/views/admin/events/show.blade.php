@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-primary" href="{{ route('admin.events.edit',$event->id) }}">
                    {{ trans('global.edit') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.cover') }}
                        </th>
                        <td>
                            @if($event->cover)
                                    <img src="{{ $event->cover->thumbnail }}" width="150px" >
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <td>
                            {{ $event->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_date') }}
                        </th>
                        <td>
                            {{ $event->event_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.is_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $event->is_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.address') }}
                        </th>
                        <td>
                            {{ $event->address }}

                            @if ($event->latdec!='' && $event->londec!='')
            
                            <div class="mt-4 form-group embed-responsive embed-responsive-21by9">
                            <iframe src = "https://maps.google.com/maps?q={{$event->latdec}},{{$event->londec}}&hl=es;z=14&amp;output=embed"></iframe>
                            </div>

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.organiser_details') }}
                        </th>
                        <td>
                            {{ $event->organiser_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.slug') }}
                        </th>
                        <td>
                            {{ $event->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.scan_code') }}
                        </th>
                        <td>
                            {{ $event->scan_code }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
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
            <a class="nav-link" href="#event_tickets" role="tab" data-toggle="tab">
                {{ trans('cruds.ticket.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="event_tickets">
            @includeIf('admin.events.relationships.eventTickets', ['tickets' => $event->eventTickets])
        </div>
    </div>
</div>

@endsection