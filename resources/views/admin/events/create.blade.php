@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cover">{{ trans('cruds.event.fields.cover') }}</label>
                <div class="needsclick dropzone {{ $errors->has('cover') ? 'is-invalid' : '' }}" id="cover-dropzone">
                </div>
                @if($errors->has('cover'))
                    <span class="text-danger">{{ $errors->first('cover') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.cover_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.event.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_date">{{ trans('cruds.event.fields.event_date') }}</label>
                <input class="form-control datetime {{ $errors->has('event_date') ? 'is-invalid' : '' }}" type="text" name="event_date" id="event_date" value="{{ old('event_date') }}" required>
                @if($errors->has('event_date'))
                    <span class="text-danger">{{ $errors->first('event_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_date_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="form-check {{ $errors->has('is_online') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_online" id="is_online" value="1" required {{ old('is_online', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_online">{{ trans('cruds.event.fields.is_online') }}</label>
                </div>
                @if($errors->has('is_online'))
                    <span class="text-danger">{{ $errors->first('is_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.is_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.event.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="organiser_details">{{ trans('cruds.event.fields.organiser_details') }}</label>
                <textarea class="form-control {{ $errors->has('organiser_details') ? 'is-invalid' : '' }}" name="organiser_details" id="organiser_details" required>{{ old('organiser_details') }}</textarea>
                @if($errors->has('organiser_details'))
                    <span class="text-danger">{{ $errors->first('organiser_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.organiser_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.event.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.slug_helper') }}</span>
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
    Dropzone.options.coverDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 1650
    },
    success: function (file, response) {
      $('form').find('input[name="cover"]').remove()
      $('form').append('<input type="hidden" name="cover" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cover"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($event) && $event->cover)
      var file = {!! json_encode($event->cover) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.thumbnail)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="cover" value="' + file.file_name + '">')
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