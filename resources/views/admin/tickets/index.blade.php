@extends('layouts.admin')
@section('content')
@can('ticket_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tickets.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.ticket.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ticket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Ticket">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.total_available') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.currency') }}
                        </th>

                        <th>
                            {{ trans('cruds.ticket.fields.ticket_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $key => $ticket)
                        <tr data-entry-id="{{ $ticket->id }}">
                            <td>

                            </td>
                            <td>
                                {{ substr($ticket->created_at,0,10) ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->event->name ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->name ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->total_available ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->price ?? '' }}
                            </td>
                            <td>
                                {{ App\Ticket::CURRENCY_SELECT[$ticket->currency] ?? '' }}
                            </td>

                            <td>
                                @if($ticket->ticket_image)
                                        <img src="{{ $ticket->ticket_image->thumbnail }}" width="50px" height="50px">
                                @endif
                            </td>
                            <td>
                                @can('ticket_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tickets.show', $ticket->id) }}">
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
@can('ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tickets.massDestroy') }}",
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
  $('.datatable-Ticket:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection