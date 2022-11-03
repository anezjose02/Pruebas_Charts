@extends('adminlte::page')

@section('title', 'Configuración global')

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
                            Configuración global
                        </h1>
                    </div>
                    <div class="col-sm-6 p-0">
                        <b-breadcrumb class="float-right">
                            <b-breadcrumb-item href="#home">
                                {{-- <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon> --}}
                                {{-- {{ Auth::user()->sistema ? '(' . Auth::user()->sistema . ') ' : '' }} --}}
                                Inicio
                            </b-breadcrumb-item>
                            <b-breadcrumb-item active>Configuración global</b-breadcrumb-item>
                        </b-breadcrumb>
                    </div>
                </div>
            </div>
        </div>

        <b-card no-body style="max-width:1000px">
            <b-card-body class="p-3">

                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <b-form-group class="col-12 col-md-6 col-xl-4" label="">
                            <label for="">{{ $globales[2]->nombre }}</label>
                            <b-form-input class="form-control-sm" name="nombre_sistema" value="{{ $globales[2]->valor }}">
                            </b-form-input>
                        </b-form-group>
                        <b-form-group class="col-12 col-md-6 col-xl-4" label="">
                            <label for="">{{ $globales[0]->nombre }}</label>
                            <b-form-input class="form-control-sm" name="texto_logo" value="{{ $globales[0]->valor }}">
                            </b-form-input>
                        </b-form-group>

                        <div class="col-12 col-md-6 col-xl-4">
                            <label for="">Logo de empresa</label>
                            <b-form-file v-model="url_logo" name="url_logo" accept="image/png, image/jpeg, image/jpg"
                                :state="true" multiple placeholder="Subir logotipo..."
                                drop-placeholder="Arrastre sus imagenes aqui..." size="sm"></b-form-file>
                        </div>

                        {{-- <b-form-group class="col-12 col-md-2" label="{{ $globales[1]->nombre }}"
                            description="Llenar solo si desea cambiar el logo.">
                            <input class="form-control-sm" type="file" name="url_logo" accept="image/png"
                                class="form-control">


                        </b-form-group> --}}

                        
                        <div class="col-12">
                            <button class="float-right btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </form>

            </b-card-body>
        </b-card>

    </div>
@stop

@section('css')

@stop

@section('js')

@stop
