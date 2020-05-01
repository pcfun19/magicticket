@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.savedCustomer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.saved-customers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.id') }}
                        </th>
                        <td>
                            {{ $savedCustomer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.provider') }}
                        </th>
                        <td>
                            {{ $savedCustomer->provider }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.code') }}
                        </th>
                        <td>
                            {{ $savedCustomer->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.method_type') }}
                        </th>
                        <td>
                            {{ $savedCustomer->method_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.savedCustomer.fields.slug') }}
                        </th>
                        <td>
                            {{ $savedCustomer->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.saved-customers.index') }}">
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
            <a class="nav-link" href="#method_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="method_payments">
            @includeIf('admin.savedCustomers.relationships.methodPayments', ['payments' => $savedCustomer->methodPayments])
        </div>
    </div>
</div>

@endsection