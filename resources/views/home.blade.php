@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    {{-- <h1 class="m-0 ">Inicio </h1> --}}
@stop

@section('content')
<div id="app">
    <div class="title-ventas">
        <div class="content-title-ventas">
            <div class="row m-auto" style="width:100%">
                <div class="col-sm-6 p-0">
                    <h1 class="m-0">
                       Inicio
                    </h1>
                </div>
                <div class="col-sm-6 p-0">
                    
                    <div class="dropdown float-right ml-2">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-plus"></i> Nueva
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="/facturar"> <i class=" fas fa-file-invoice"></i> Factura de venta</a>
                          <a class="dropdown-item" href="/proforma"> <i class=" fas fa-file"></i> Proforma</a>
                          <a class="dropdown-item" href="/nota-credito"> <i class=" fas fa-file-invoice-dollar"></i> Nota de crédito</a>
                        </div>
                      </div>
                    {{-- <button class="btn btn-info">
                        <i class="fas fa-plus"></i> Nueva
                    </button> --}}

                    {{-- <b-breadcrumb class="float-right">
                        <b-breadcrumb-item href="#home">
                          
                            Inicio
                        </b-breadcrumb-item>
                        <b-breadcrumb-item active>{{ @$titulo }}</b-breadcrumb-item>
                    </b-breadcrumb> --}}
                   
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">

        <div class="col-lg-3 col-6">
         
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                   
                    <i class="fas fa-box"></i>
                </div>
                
            </div>
        </div>
        
        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion fas fa-percent"></i>
                </div>
               
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                    
                </div>
                
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                
            </div>
        </div>

    </div>
 
   
@stop
