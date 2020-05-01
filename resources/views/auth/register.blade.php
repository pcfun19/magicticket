@extends('layouts.app')
@section('content')

<div class="login-box">
    
    <div class="card">
        <div class="card-body login-card-body">

            <div class="login-logo">
            <div class="login-logo">
                <a href="{{route('guest.home')}}">
                    <img src="{{asset('logo.png')}}" width="100%">
                </a>
            </div>
            </div>

            <p class="col-12  mb-3 p-0">By using this website you fully understand and accept our <a href="{{route('pages.static','terms')}}">Terms of Service.</a> </p>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="confirm btn btn-primary btn-block btn-flat">
                            {{ trans('global.register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="form-group text-center">
                <label for="name" class=" bg-light col-md-12 control-label">Go to Login</label>
                <div class="col-md-12">
                     <a  href="{{ route('login') }}"> {{ trans('global.login') }} </a>
                </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

<script type="text/javascript">
    $('.confirm').on('click', function () {
        var message = 'By using our platform you have read, understood and agree with our Terms of Service and all our Policies. Click OK to continue or cancel if you do not agree.';
        action = confirm(message) ? true : event.preventDefault();
    });
</script> -->
@endsection