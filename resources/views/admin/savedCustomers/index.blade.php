@extends('layouts.admin')
@section('content')
@can('saved_customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.saved-customers.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.savedCustomer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.savedCustomer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SavedCustomer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.provider') }}
                        </th>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.method_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.slug') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savedCustomers as $key => $savedCustomer)
                        <tr data-entry-id="{{ $savedCustomer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $savedCustomer->id ?? '' }}
                            </td>
                            <td>
                                {{ $savedCustomer->provider ?? '' }}
                            </td>
                            <td>
                                {{ $savedCustomer->code ?? '' }}
                            </td>
                            <td>
                                {{ $savedCustomer->method_type ?? '' }}
                            </td>
                            <td>
                                {{ $savedCustomer->slug ?? '' }}
                            </td>
                            <td>
                                @can('saved_customer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.saved-customers.show', $savedCustomer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('saved_customer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.saved-customers.edit', $savedCustomer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('saved_customer_delete')
                                    <form action="{{ route('admin.saved-customers.destroy', $savedCustomer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('saved_customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.saved-customers.massDestroy') }}",
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
  $('.datatable-SavedCustomer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection