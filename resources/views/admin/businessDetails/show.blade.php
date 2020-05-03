@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $businessDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessDetail.fields.name') }}
                        </th>
                        <td>
                            {{ $businessDetail->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessDetail.fields.taxid') }}
                        </th>
                        <td>
                            {{ $businessDetail->taxid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessDetail.fields.passport') }}
                        </th>
                        <td>
                            @foreach($businessDetail->passport as $key => $media)
                                <a href="{{ $media->thumbnail }}" target="_blank">
                                    <img src="{{ $media->thumbnail }}" width="50px" height="50px">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessDetail.fields.documents') }}
                        </th>
                        <td>
                            @foreach($businessDetail->documents as $key => $media)
                                <a href="{{ $media->url}}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessDetail.fields.activities_details') }}
                        </th>
                        <td>
                            {{ $businessDetail->activities_details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection