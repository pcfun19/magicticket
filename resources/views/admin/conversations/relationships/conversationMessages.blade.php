<div class="m-3">
    @can('message_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.messages.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.message.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.message.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-conversationMessages">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.message.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.conversation') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.uuid') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.recipient') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.read') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.assets') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.message.fields.created_by') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $key => $message)
                            <tr data-entry-id="{{ $message->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $message->id ?? '' }}
                                </td>
                                <td>
                                    {{ $message->conversation->uuid ?? '' }}
                                </td>
                                <td>
                                    {{ $message->uuid ?? '' }}
                                </td>
                                <td>
                                    {{ $message->recipient->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $message->read ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $message->read ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @foreach($message->assets as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $message->price ?? '' }}
                                </td>
                                <td>
                                    {{ $message->created_by->name ?? '' }}
                                </td>
                                <td>
                                    @can('message_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.messages.show', $message->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('message_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.messages.edit', $message->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('message_delete')
                                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('message_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.messages.massDestroy') }}",
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
  $('.datatable-conversationMessages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection