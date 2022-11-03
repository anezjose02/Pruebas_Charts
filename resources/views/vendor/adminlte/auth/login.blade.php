@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
@php($password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
    @php($password_reset_url = $password_reset_url ? route($password_reset_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
    @php($password_reset_url = $password_reset_url ? url($password_reset_url) : '')
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')

    <div class="text-center">
        <img style="width:110px" src="{{ asset('/img/default/logo.jpg') }}" alt="">

    </div>
    <br>
    <h6 class="text-center text-primary">Inicio de sesión</h6>
    <br>



    <form action="{{ $login_url }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="form-group">

            <div class="icon-placeholder">
                {{-- <i class="icon fas fa-envelope"></i> --}}
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
            </div>
            <div>
                @error('email')
                    <label for="" class="text-danger">{{ $message }}</label>
                @enderror
            </div>

        </div>

        {{-- Password field --}}
        <div class="form-group">

            <div class="icon-placeholder input_pass">
                {{-- <i class="icon fas fa-lock" style="margin-top:-1.5px"></i> --}}
                <span id="show_pass" class="show_pass far fa-eye" onclick="showPass()"></span>
                <span style="display: none" id="hide_pass" class="show_pass far fa-eye-slash" onclick="showPass()"></span>
                <input id="input_password" type="password" name="password"
                    class="form-control  @error('password') is-invalid @enderror" value="{{ old('password') }}"
                    placeholder="{{ __('adminlte::adminlte.password') }}" autofocus>
            </div>
       
            @error('password')
                <label for="" class="text-danger">{{ $message }}</label>
            @enderror

        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('adminlte::adminlte.remember_me') }}
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit
                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    {{-- Password reset link --}}
    <div class="text-center mt-4">
        @if ($password_reset_url)
            <p class="my-0">
                <a href="{{ $password_reset_url }}">
                    {{ __('adminlte::adminlte.i_forgot_my_password') }}
                </a>
            </p>
            <br>
            <p> Al acceder a este sistema usted acepta los
                <a href="">terminos y condiciones</a>
                del servicio
            <p>
        @endif

    </div>
    {{-- Register link --}}
    {{-- @if ($register_url)
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif --}}
@stop

@section('js')
    <script>
        function showPass() {

            // document.getElementById('show_pass').classList.add = 'fa-eye-slash';
            console.log(document.getElementById('show_pass').classList);
            var type = document.getElementById('input_password').type;
            if (type == 'password') {
                document.getElementById('input_password').type = 'text';
                document.getElementById('show_pass').style.display = "none";
                document.getElementById('hide_pass').style.display = "block";

            } else {
                document.getElementById('input_password').type = 'password';
                document.getElementById('hide_pass').style.display = "none";
                document.getElementById('show_pass').style.display = "block";
            }
        }
    </script>
@endsection
