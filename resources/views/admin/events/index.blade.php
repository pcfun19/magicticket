@extends('layouts.admin')
@section('content')
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.events.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                    <tr>
                        <th width="10">

                        </th>

                        <th>
                            {{ trans('cruds.event.fields.cover') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>

                        <th>
                            {{ trans('cruds.event.fields.is_online') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.event_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.scan_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.slug') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        <tr data-entry-id="{{ $event->id }}">
                            <td>

                            </td>

                            <td>
                                @if($event->cover)
                                    <img src="{{ $event->cover->thumbnail }}" width="50px" height="50px">
                                @endif
                            </td>
                            <td>
                                {{ $event->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $event->is_online ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $event->is_online ? 'checked' : '' }}>
                            </td>
                            
                            <td>
                                {{ $event->event_date ?? '' }}
                            </td>                            

                            <td>
                                {{ $event->scan_code ?? '' }}
                            </td>
                            <td>
                                {{ $event->slug ?? '' }}
                            </td>
                            <td>
                                @can('event_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.events.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection