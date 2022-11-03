@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
    <div class="row w-100 h-100 ">
        <div class="col-12 col-md-8 col-xl-8 p-0 d-none d-md-block">
            <div style="position: absolute;top:0;bottom:0;left:0;right:0;background:#1f20552c;z-index:55">

            </div>
            <img style="width: 100%;height:100%;object-fit:cover" src="{{asset('img\default\banner-principal.jpg')}}" alt="">
        </div>
        <div class="col-12 col-md-4 col-xl-4 d-flex align-items-center bg-white">
            <div class="{{ $auth_type ?? 'login' }}-box m-auto">
                @yield('auth_body')
                @yield('auth_footer')
            </div>
        </div>
    </div>

@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
