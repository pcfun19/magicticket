@extends('layouts.app')
@section('content')
<div class="login-box">

    <div class="card">
        <div class="card-body login-card-body">
            <div class="login-logo">
                <div class="login-logo">
                    <a href="{{ route('guest.home') }}">
                        <img src="{{asset('logo.png')}}" width="100%">
                    </a>
                </div>
            </div>
            <!-- <p class="login-box-msg">
                {{ trans('global.login') }}
            </p> -->

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <p class="col-12  mb-3 p-0">By using this website you fully understand and accept our <a href="{{route('pages.static','terms')}}">Terms of Service.</a> </p>
            <label class="col-md-12 mb-3 control-label text-center text-white" style="background-color:#05999f;">Login with Email</label>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button class="confirm" type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif

            <div class="form-group text-center mt-3">
                <label for="name" class="col-md-12 control-label text-white" style="background-color:#b2d03e;">Social Login/Register</label>
                <div class="col-md-12">
                    <a  href="{{ url('login/facebook') }}" class="confirm btn btn-social-icon btn-facebook"><i class="fab fa-facebook-square fa-3x"></i></a>
                    <a  href="{{ url('login/google') }}" class="confirm btn btn-social-icon btn-google-plus"><i class="fab fa-google-plus-square fa-3x"></i></a>
                    <a  href="{{ url('login/linkedin') }}" class="confirm btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin fa-3x"></i></a>
                    <a  href="{{ url('login/github') }}" class="confirm btn btn-social-icon btn-github"><i class="fab fa-github-square fa-3x"></i></a>
                </div>
            </div>

        </div>

        <div class="form-group text-center">
                <label for="name" class=" bg-light col-md-12 control-label">Register With Email</label>
                <div class="col-md-12">
                     <a  href="{{ route('register') }}"> {{ trans('global.register') }} </a>
                </div>
        </div>
        
        
        </div>
        <!-- /.login-card-body -->


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