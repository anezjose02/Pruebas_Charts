@extends('adminlte::page')

@section('title', @$titulo ?? 'Inicio')

@section('content_header')
    {{-- <h1>{{@$titulo}}</h1> --}}
@stop

@section('content')

    <div id="app">
       
        <div class="content-header px-0 py-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-0">
                        <h1 class="m-0">
                            Temas - Colores
                        </h1>
                    </div>
                    <div class="col-sm-6 p-0">
                        <b-breadcrumb class="float-right">
                            <b-breadcrumb-item href="#home">
                                {{-- <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon> --}}
                                {{-- {{ Auth::user()->sistema ? '(' . Auth::user()->sistema . ') ' : '' }} --}}
                                Inicio
                            </b-breadcrumb-item>
                            <b-breadcrumb-item active> Temas - colores</b-breadcrumb-item>
                        </b-breadcrumb>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   

    <h5>Temas</h5>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/azul" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "azul") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5>Azul (predefinido) </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/verde-azulado" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "verde") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5>Verde </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        {{-- <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/dorado" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "dorado") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Dorado </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div> --}}
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/naranja" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "naranja") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Naranja </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/rojo" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "rojo") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Rojo </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/azul-cobalto" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "azul-cobalto") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Azul cobalto </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/purpura" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "purpura") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Púrpura </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-tema/cafe" class="btn btn-primary btn-sm float-right @if(Auth::user()->tema_seleccionado == "cafe") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Café </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        
    </div>

    <h5>Barra Lateral ( {{Auth::user()->barra_lateral}} ) </h5>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-barra-lateral/gris" class="btn btn-primary btn-sm float-right @if(Auth::user()->barra_lateral == "gris" || Auth::user()->barra_lateral == Null) disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Gris (predefinido) </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-barra-lateral/negra" class="btn btn-primary btn-sm float-right @if(Auth::user()->barra_lateral == "negra") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5>Negra </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-barra-lateral/blanca" class="btn btn-primary btn-sm float-right @if(Auth::user()->barra_lateral == "blanca") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5>Blanca </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
       
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="/cambiar-barra-lateral/azul-obscuro" class="btn btn-primary btn-sm float-right @if(Auth::user()->barra_lateral == "azul-obscuro") disabled @endif"> <i class="fas fa-check"></i> </a>
                    <h5> Azul obscuro </h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>




@stop

@section('css')

@stop

@section('js')

@stop
