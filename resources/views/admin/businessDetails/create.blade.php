@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.businessDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.business-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.businessDetail.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.businessDetail.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="taxid">{{ trans('cruds.businessDetail.fields.taxid') }}</label>
                <input class="form-control {{ $errors->has('taxid') ? 'is-invalid' : '' }}" type="text" name="taxid" id="taxid" value="{{ old('taxid', '') }}" required>
                @if($errors->has('taxid'))
                    <span class="text-danger">{{ $errors->first('taxid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.businessDetail.fields.taxid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="passport">{{ trans('cruds.businessDetail.fields.passport') }}</label>
                <div class="needsclick dropzone {{ $errors->has('passport') ? 'is-invalid' : '' }}" id="passport-dropzone">
                </div>
                @if($errors->has('passport'))
                    <span class="text-danger">{{ $errors->first('passport') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.businessDetail.fields.passport_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="documents">{{ trans('cruds.businessDetail.fields.documents') }}</label>
                <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}" id="documents-dropzone">
                </div>
                @if($errors->has('documents'))
                    <span class="text-danger">{{ $errors->first('documents') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.businessDetail.fields.documents_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="activities_details">{{ trans('cruds.businessDetail.fields.activities_details') }}</label>
                <textarea class="form-control {{ $errors->has('activities_details') ? 'is-invalid' : '' }}" name="activities_details" id="activities_details" required>{{ old('activities_details') }}</textarea>
                @if($errors->has('activities_details'))
                    <span class="text-danger">{{ $errors->first('activities_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.businessDetail.fields.activities_details_helper') }}</span>
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
    var uploadedPassportMap = {}
Dropzone.options.passportDropzone = {
    url: '{{ route('admin.business-details.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="passport[]" value="' + response.name + '">')
      uploadedPassportMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPassportMap[file.name]
      }
      $('form').find('input[name="passport[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($businessDetail) && $businessDetail->passport)
      var files =
        {!! json_encode($businessDetail->passport) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="passport[]" value="' + file.file_name + '">')
        }
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
<script>
    var uploadedDocumentsMap = {}
Dropzone.options.documentsDropzone = {
    url: '{{ route('admin.business-details.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="documents[]" value="' + response.name + '">')
      uploadedDocumentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentsMap[file.name]
      }
      $('form').find('input[name="documents[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($businessDetail) && $businessDetail->documents)
          var files =
            {!! json_encode($businessDetail->documents) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="documents[]" value="' + file.file_name + '">')
            }
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