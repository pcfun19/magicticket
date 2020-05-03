@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ticket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tickets.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="event_id">{{ trans('cruds.ticket.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id">
                    @foreach($events as $id => $event)
                        <option value="{{ $id }}" {{ old('event_id') == $id ? 'selected' : '' }}>{{ $event }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <span class="text-danger">{{ $errors->first('event') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.ticket.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_available">{{ trans('cruds.ticket.fields.total_available') }}</label>
                <input class="form-control {{ $errors->has('total_available') ? 'is-invalid' : '' }}" type="number" name="total_available" id="total_available" value="{{ old('total_available', '1') }}" step="1" required>
                @if($errors->has('total_available'))
                    <span class="text-danger">{{ $errors->first('total_available') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.total_available_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.ticket.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '5') }}" step="0.01" required min="5">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.ticket.fields.currency') }}</label>
                <select class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency" id="currency" required>
                    <option value disabled {{ old('currency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Ticket::CURRENCY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('currency', 'eur') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="includes">{{ trans('cruds.ticket.fields.includes') }}</label>
                <textarea class="form-control {{ $errors->has('includes') ? 'is-invalid' : '' }}" name="includes" id="includes" required>{{ old('includes') }}</textarea>
                @if($errors->has('includes'))
                    <span class="text-danger">{{ $errors->first('includes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.includes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instructions">{{ trans('cruds.ticket.fields.instructions') }}</label>
                <textarea class="form-control {{ $errors->has('instructions') ? 'is-invalid' : '' }}" name="instructions" id="instructions">{{ old('instructions') }}</textarea>
                @if($errors->has('instructions'))
                    <span class="text-danger">{{ $errors->first('instructions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.instructions_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ticket_image">{{ trans('cruds.ticket.fields.ticket_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ticket_image') ? 'is-invalid' : '' }}" id="ticket_image-dropzone">
                </div>
                @if($errors->has('ticket_image'))
                    <span class="text-danger">{{ $errors->first('ticket_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.ticket_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="top_margin">{{ trans('cruds.ticket.fields.top_margin') }}</label>
                <input class="form-control {{ $errors->has('top_margin') ? 'is-invalid' : '' }}" type="number" name="top_margin" id="top_margin" value="{{ old('top_margin', '0') }}" step="1" required>
                @if($errors->has('top_margin'))
                    <span class="text-danger">{{ $errors->first('top_margin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.top_margin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="left_margin">{{ trans('cruds.ticket.fields.left_margin') }}</label>
                <input class="form-control {{ $errors->has('left_margin') ? 'is-invalid' : '' }}" type="number" name="left_margin" id="left_margin" value="{{ old('left_margin', '') }}" step="1" required>
                @if($errors->has('left_margin'))
                    <span class="text-danger">{{ $errors->first('left_margin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.left_margin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="font_size">{{ trans('cruds.ticket.fields.font_size') }}</label>
                <input class="form-control {{ $errors->has('font_size') ? 'is-invalid' : '' }}" type="number" name="font_size" id="font_size" value="{{ old('font_size', '') }}" step="1" required>
                @if($errors->has('font_size'))
                    <span class="text-danger">{{ $errors->first('font_size') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.font_size_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="font_angle">{{ trans('cruds.ticket.fields.font_angle') }}</label>
                <input class="form-control {{ $errors->has('font_angle') ? 'is-invalid' : '' }}" type="number" name="font_angle" id="font_angle" value="{{ old('font_angle', '0') }}" step="1" required>
                @if($errors->has('font_angle'))
                    <span class="text-danger">{{ $errors->first('font_angle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.font_angle_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.ticketImageDropzone = {
    url: '{{ route('admin.tickets.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="ticket_image"]').remove()
      $('form').append('<input type="hidden" name="ticket_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="ticket_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ticket) && $ticket->ticket_image)
      var file = {!! json_encode($ticket->ticket_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $ticket->ticket_image->thumbnail}}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="ticket_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection