@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@php($password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email'))

@if (config('adminlte.use_route_url', false))
    @php($password_email_url = $password_email_url ? route($password_email_url) : '')
@else
    @php($password_email_url = $password_email_url ? url($password_email_url) : '')
@endif

@section('auth_header', __('adminlte::adminlte.password_reset_message'))

@section('auth_body')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ $password_email_url }}" method="post">
        @csrf

        <div class="text-center">
            <img style="width:110px" src="{{ asset('/img/default/logo.jpg') }}" alt="">

        </div>
        <br>
        <h6 class="text-center text-primary">Recuperar contraseña </h6>
        <br>


        <p>Agregue su correo electrónico, donde recibirá el enlace que le permitirá recuperar su contraseña. </p>
        {{-- Email field --}}
        <div class="form-group">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            {{-- <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div> --}}

            @error('email')
                <label for="" class="text-danger">{{ $message }}</label>
            @enderror

        </div>

        {{-- Send reset link button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-paper-plane"></span>
            Solicitar enlace
        </button>

        <a href="/" type="submit" class="btn btn-block btn-secondary">
            <span class="fas fa-bakkward"></span>
            Cancelar
        </a>

    </form>

@stop
