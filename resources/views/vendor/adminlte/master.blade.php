<?php
use App\Globales;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   
    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', Globales::global('nombre_sistema')->valor)
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')
   

    <link rel="stylesheet" href="{{ asset('css/DonutWidget.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400;1,500&family=Roboto:ital,wght@0,400;0,500;1,400;1,500&display=swap"
        rel="stylesheet">

    {{-- Base Stylesheets --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700"> --}}
        {{-- <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/jc-style.css') }}">


    {{-- CUSTOM STYLES --}}
    @if (!Auth::check())
        <link rel="stylesheet" href="{{ asset('css/background-blue.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar-grey.css') }}">
    @else
        @if (Auth::user()->tema_seleccionado == 'azul' || Auth::user()->tema_seleccionado == null)
            <link rel="stylesheet" href="{{ asset('css/background-blue.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'verde-azulado')
            <link rel="stylesheet" href="{{ asset('css/background-green-blue.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'dorado')
            <link rel="stylesheet" href="{{ asset('css/background-gold.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'naranja')
            <link rel="stylesheet" href="{{ asset('css/background-orange.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'rojo')
            <link rel="stylesheet" href="{{ asset('css/background-red-1.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'azul-cobalto')
            <link rel="stylesheet" href="{{ asset('css/background-blue-cobalt.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'purpura')
            <link rel="stylesheet" href="{{ asset('css/background-purple.css') }}">
        @elseif(Auth::user()->tema_seleccionado == 'cafe')
            <link rel="stylesheet" href="{{ asset('css/background-coffe.css') }}">
        @endif

        @if (Auth::user()->barra_lateral == 'gris' || Auth::user()->barra_lateral == null)
            <link rel="stylesheet" href="{{ asset('css/sidebar-grey.css') }}">
        @elseif(Auth::user()->barra_lateral == 'negra')
            <link rel="stylesheet" href="{{ asset('css/sidebar-black.css') }}">
        @elseif(Auth::user()->barra_lateral == 'blanca')
            <link rel="stylesheet" href="{{ asset('css/sidebar-white.css') }}">
        @elseif(Auth::user()->barra_lateral == 'azul-obscuro')
            <link rel="stylesheet" href="{{ asset('css/sidebar-blue.css') }}">
        @endif


    @endif

    <link rel="stylesheet" href="{{ asset('css/general-styles.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    {{--  --}}

    {{-- Favicon --}}
    @if (config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"
            href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif
             <script
            src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ asset('js/DonutWidget.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        

</head>

<body class="@yield('classes_body')" @yield('body_data')>

    <div class="container-loader2" id="precarga">
        <div class="jc-precarga">
            <div class="jc-loader">
                <div class="jc-logo"></div>
            </div>
            <div class="jc-loader-text">
                {{ Globales::global('nombre_sistema')->valor }}
            </div>
        </div>
    </div>

    {{-- <div class="loader" id="precarga" >
        <img  src="{{asset('\img\default\loading.gif')}}" alt="">
    </div> --}}

    {{-- Body Content --}}
    @yield('body')



    @if (session('success'))
        @php
            echo "
                <script>
                    Swal.fire(
                        '¡Operación exitosa!',
                        '".session("success")."',
                        'success'
                    )
                </script>
            ";
        @endphp
    @endif
    @if (session('warning'))
        @php
            echo "
                <script>
                    Swal.fire(
                        'Advertencia!',
                        '".session("warning")."',
                        'warning'
                    )
                </script>
            ";
        @endphp
    @endif
    @if (session('info'))
        @php
            echo "
                <script>
                    Swal.fire(
                        'Información',
                        '".session("info")."',
                        'info'
                    )
                </script>
            ";
        @endphp
    @endif
    @if (session('danger'))
        @php
            echo "
                <script>
                    Swal.fire(
                        'Error',
                        '".session("danger")."',
                        'error'
                    )
                </script>
            ";
        @endphp
    @endif

    {{-- Livewire Script --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

    <script>
        window.onload = function() {
            let precarga = document.getElementById("precarga");
            precarga.style.display = "none";
        };
    </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Base Scripts --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>


        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        {{-- <link rel="stylesheet" href="{{ asset('bootstrap-4.0.0/dist/css/bootstrap.min.css') }}"> --}}

        {{-- <script src="{{ asset('jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('bootstrap-4.0.0/dist/js/bootstrap.bundle.min.js') }}" ></script> --}}

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif


    <script>
        // $('.dropdown-toggle').click(function() {
        //     abierto = $(this).parent('.dropdown').find('.dropdown-menu').hasClass('show');
        //     abierto2 = $(this).parent('.dropup').find('.dropdown-menu').hasClass('show');

        //     $('.dropdown-menu').removeClass('show');

        //     if (abierto || abierto2) {
        //         $(this).parent('.dropdown').find('.dropdown-menu').removeClass('show')
        //         $(this).parent('.dropup').find('.dropdown-menu').removeClass('show')
        //     } else {
        //         $(this).parent('.dropdown').find('.dropdown-menu').addClass('show')
        //         $(this).parent('.dropup').find('.dropdown-menu').addClass('show')
        //     }

        // });

        // $('.dropdown-menu').click(function() {

        //     $(this).removeClass('show');
        // });

        // $('.dropdown').mouseleave(function() {
        //     $(this).parent('.dropdown').find('.dropdown-menu').removeClass('show')
        // });


        // $('.container-fluid').mouseleave(function() {
        //     $('.dropdown-menu').removeClass('show');
        // });

        // $('.table').mouseleave(function() {

        //     $('.dropdown-menu').removeClass('show');
        // });

        // $('.row').click(function() {
        //     $('.dropdown-menu').removeClass('show');
        // });
    </script>
</body>

</html>
