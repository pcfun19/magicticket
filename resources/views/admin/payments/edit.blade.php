@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="uuid">{{ trans('cruds.payment.fields.uuid') }}</label>
                <input class="form-control {{ $errors->has('uuid') ? 'is-invalid' : '' }}" type="text" name="uuid" id="uuid" value="{{ old('uuid', $payment->uuid) }}" required>
                @if($errors->has('uuid'))
                    <span class="text-danger">{{ $errors->first('uuid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.uuid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ticket_id">{{ trans('cruds.payment.fields.ticket') }}</label>
                <select class="form-control select2 {{ $errors->has('ticket') ? 'is-invalid' : '' }}" name="ticket_id" id="ticket_id" required>
                    @foreach($tickets as $id => $ticket)
                        <option value="{{ $id }}" {{ ($payment->ticket ? $payment->ticket->id : old('ticket_id')) == $id ? 'selected' : '' }}>{{ $ticket }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket'))
                    <span class="text-danger">{{ $errors->first('ticket') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.ticket_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.payment.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Payment::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $payment->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="method_id">{{ trans('cruds.payment.fields.method') }}</label>
                <select class="form-control select2 {{ $errors->has('method') ? 'is-invalid' : '' }}" name="method_id" id="method_id" required>
                    @foreach($methods as $id => $method)
                        <option value="{{ $id }}" {{ ($payment->method ? $payment->method->id : old('method_id')) == $id ? 'selected' : '' }}>{{ $method }}</option>
                    @endforeach
                </select>
                @if($errors->has('method'))
                    <span class="text-danger">{{ $errors->first('method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="refunded_at">{{ trans('cruds.payment.fields.refunded_at') }}</label>
                <input class="form-control datetime {{ $errors->has('refunded_at') ? 'is-invalid' : '' }}" type="text" name="refunded_at" id="refunded_at" value="{{ old('refunded_at', $payment->refunded_at) }}">
                @if($errors->has('refunded_at'))
                    <span class="text-danger">{{ $errors->first('refunded_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.refunded_at_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('chargedback') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="chargedback" value="0">
                    <input class="form-check-input" type="checkbox" name="chargedback" id="chargedback" value="1" {{ $payment->chargedback || old('chargedback', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="chargedback">{{ trans('cruds.payment.fields.chargedback') }}</label>
                </div>
                @if($errors->has('chargedback'))
                    <span class="text-danger">{{ $errors->first('chargedback') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.chargedback_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="affiliate_user_id">{{ trans('cruds.payment.fields.affiliate_user') }}</label>
                <select class="form-control select2 {{ $errors->has('affiliate_user') ? 'is-invalid' : '' }}" name="affiliate_user_id" id="affiliate_user_id" required>
                    @foreach($affiliate_users as $id => $affiliate_user)
                        <option value="{{ $id }}" {{ ($payment->affiliate_user ? $payment->affiliate_user->id : old('affiliate_user_id')) == $id ? 'selected' : '' }}>{{ $affiliate_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('affiliate_user'))
                    <span class="text-danger">{{ $errors->first('affiliate_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.affiliate_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_scanned">{{ trans('cruds.payment.fields.first_scanned') }}</label>
                <input class="form-control datetime {{ $errors->has('first_scanned') ? 'is-invalid' : '' }}" type="text" name="first_scanned" id="first_scanned" value="{{ old('first_scanned', $payment->first_scanned) }}">
                @if($errors->has('first_scanned'))
                    <span class="text-danger">{{ $errors->first('first_scanned') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.first_scanned_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_scanned">{{ trans('cruds.payment.fields.last_scanned') }}</label>
                <input class="form-control datetime {{ $errors->has('last_scanned') ? 'is-invalid' : '' }}" type="text" name="last_scanned" id="last_scanned" value="{{ old('last_scanned', $payment->last_scanned) }}">
                @if($errors->has('last_scanned'))
                    <span class="text-danger">{{ $errors->first('last_scanned') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.last_scanned_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="created_by_id">{{ trans('cruds.payment.fields.created_by') }}</label>
                <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by_id" id="created_by_id" required>
                    @foreach($created_bies as $id => $created_by)
                        <option value="{{ $id }}" {{ ($payment->created_by ? $payment->created_by->id : old('created_by_id')) == $id ? 'selected' : '' }}>{{ $created_by }}</option>
                    @endforeach
                </select>
                @if($errors->has('created_by'))
                    <span class="text-danger">{{ $errors->first('created_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.created_by_helper') }}</span>
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