@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.savedCustomer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.saved-customers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="provider">{{ trans('cruds.savedCustomer.fields.provider') }}</label>
                <input class="form-control {{ $errors->has('provider') ? 'is-invalid' : '' }}" type="text" name="provider" id="provider" value="{{ old('provider', '') }}" required>
                @if($errors->has('provider'))
                    <span class="text-danger">{{ $errors->first('provider') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.savedCustomer.fields.provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.savedCustomer.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.savedCustomer.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="method_type">{{ trans('cruds.savedCustomer.fields.method_type') }}</label>
                <input class="form-control {{ $errors->has('method_type') ? 'is-invalid' : '' }}" type="text" name="method_type" id="method_type" value="{{ old('method_type', '') }}">
                @if($errors->has('method_type'))
                    <span class="text-danger">{{ $errors->first('method_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.savedCustomer.fields.method_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slug">{{ trans('cruds.savedCustomer.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.savedCustomer.fields.slug_helper') }}</span>
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