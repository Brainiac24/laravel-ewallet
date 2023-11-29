@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        @include('backend.errors.errors')

    <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Cрок действия пароля истек смените пароль</p>
            <form action={!! route("admin.changePassword.changePassword") !!} method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('current_password') ? 'has-error' : '' }}">
                    <input type="password" name="current_password" class="form-control"
                           placeholder="{{ trans('profile.backend.current_password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('current_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('new_password') ? 'has-error' : '' }}">
                    <input type="password" name="new_password" class="form-control"
                           placeholder="{{ trans('profile.backend.new_password')}}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('new_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="new_password_confirmation" class="form-control"
                           placeholder="{{ trans('profile.backend.new_password_confirmation') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('new_password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">Сохранить</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
