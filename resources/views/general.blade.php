@extends('adminlte::page')

@section('title', @$titulo ?? 'Inicio')

@section('content_header')
    {{-- <h1>{{@$titulo}}</h1> --}}
@stop


@section('content')
   
    <div id="app">
       
        {{-- datosfiltros="{{ json_encode(@$datosfiltros) }}" --}}
        
        <{{ @$tabla }} {{ @$props }}>
            </{{ @$tabla }}>
           
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
