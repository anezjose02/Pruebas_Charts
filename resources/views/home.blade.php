@extends('adminlte::page')

@section('title', 'Inicio')
@section('page-style')
    <!-- Page css files -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />


@endsection


@section('content_header')
    {{-- <h1 class="m-0 ">Inicio </h1> --}}

@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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
                            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-plus"></i> Nueva
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/facturar"> <i class=" fas fa-file-invoice"></i> Factura de
                                    venta</a>
                                <a class="dropdown-item" href="/proforma"> <i class=" fas fa-file"></i> Proforma</a>
                                <a class="dropdown-item" href="/nota-credito"> <i class=" fas fa-file-invoice-dollar"></i>
                                    Nota de crédito</a>
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
        <script>
            $(document).ready(function() {
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "get",
                    url: '{{ URL::to('cardsD') }}',
                    data: {
                        _token: _token
                    },
                    success: function(response) {
                        let totalF = response.facturas_pendientes.length;
                        let totalIN = response.facturas_IsNull.length;
                        let totalDA = response.documentos_autorizados.length;
                        let totalR = response.documentos_recibido.length;
                        let totalDR = response.documentos_rechazados.length;
                        let totalFDN = response.documentos_anulados.length;
                        document.getElementById("facturas").innerHTML = totalF + totalIN;
                        document.getElementById("documentos_autorizados").innerHTML = totalDA + totalR;
                        document.getElementById("documentos_rechazados").innerHTML = totalDR;
                        document.getElementById("documentos_anulados").innerHTML = totalFDN;
                    }
                });
            });
        </script>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-primary">
                <div class="inner">
                    <h3 id="facturas"></h3>
                    <p>Pendientes</p>
                </div>
                <div class="icon">

                    <i class="far fa-clock"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="documentos_autorizados"></h3>
                    <p>Autorizados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-double"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="documentos_rechazados"></h3>
                    <p>Rechazados</p>
                </div>
                <div class="icon">
                    <i class="far fa-times-circle"></i>

                </div>

            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="documentos_anulados"></h3>
                    <p>Anulados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Resumen del Sistema</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <h6 class="mb-0 w-100">
                                <div class="description-block border-right">
                                    <div class="card direct-chat direct-chat-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Total de ventas</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-chevron-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style="height: 300px;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <select class="form-control form-control-sm select2"
                                                                style="align-content: center; width:120px; heigth: 60px; border: 2px solid: black;"
                                                                id="select_total_ventas">
                                                                <option selected="selected"></option>
                                                                <option>Hoy</option>
                                                                <option>Ayer</option>
                                                                <option>Semana</option>
                                                                <option>Mes</option>
                                                            </select>
                                                        </th>
                                                        <th>
                                                            <label style="position: relative; rigth:20px;"
                                                                id="total_ventas"></label>
                                                        </th>
                                                    </tr>
                                                    <div id="complete_th_total_ventas">

                                                    </div>
                                                </thead>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </h6>

                            <script>
                                $('#select_total_ventas').blur(function(e) {
                                    e.preventDefault();

                                    let _token = $('meta[name="csrf-token"]').attr('content');
                                    let select = $('#select_total_ventas').val();
                                    console.log(select);
                                    $.ajax({
                                        type: "get",
                                        url: '{{ URL::to('selectTotalVentas') }}',
                                        data: {
                                            _token: _token,
                                            select : select
                                        },
                                        success: function(response) {
                                            console.log('====================================');
                                            console.log(response);
                                            console.log('====================================');
                                        }
                                    });

                                });
                            </script>

                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 col-6">
                            <div class="description-block border-right">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Documentos Electronicos</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="1">
                                                        <label for="">Desde</label> <br>
                                                        <input type="date" name="from" id="from"
                                                            style="align-content: center; width:120px; border: 2px solid: black;">
                                                    </th>
                                                    <th colspan="1">
                                                        <label for="">Hasta</label> <br>
                                                        <input type="date" name="to" id="to"
                                                            style="align-content: center; width:120px; border: 2px solid: black;">
                                                    </th>
                                                    <th colspan="2" rowspan="10">
                                                        <div class="example" style="position: relative; top: -60px;">
                                                        </div>


                                                    </th>
                                                </tr>
                                                <script type="text/javascript">
                                                    $('#from').blur(function() {

                                                        let from = $('#from').val();
                                                        $('#to').val('');
                                                        //$('#to').min(from);
                                                        document.getElementById("to").min = from;
                                                    });
                                                </script>
                                                <script type="text/javascript">
                                                    $('#to').blur(function() {
                                                        console.log('Pase por aqui!!');
                                                        let from = $('#from').val();
                                                        let to = $('#to').val();
                                                        console.log('Este es el from', from, 'este es el to', to);
                                                        let _token = $('meta[name="csrf-token"]').attr('content');
                                                        $.ajax({
                                                            type: "get",
                                                            url: '{{ URL::to('progressbar') }}',
                                                            data: {
                                                                _token: _token,
                                                                from: from,
                                                                to: to
                                                            },
                                                            success: function(response) {
                                                                //console.log('esta es la respuesta con las fechas;', response);
                                                                let totalF = response.facturas.length;
                                                                let totalR = response.retenciones.length;
                                                                let totalC = response.nota_credito.length;
                                                                let totalD = response.nota_debito.length;
                                                                let totalG = response.guia_remision.length;
                                                                let totalL = response.liquidacion.length;
                                                                let total = totalF + totalR + totalC + totalD + totalL + totalG;
                                                                document.querySelector('#facturas_bar').innerText = totalF;
                                                                document.querySelector('#progress-bar-facturas').style.width = "" + (totalF * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#retenciones').innerText = totalR;
                                                                document.querySelector('#progress-bar-retenciones').style.width = "" + (totalR *
                                                                    100) / 100 + "%";
                                                                document.querySelector('#nota_credito').innerText = totalC;
                                                                document.querySelector('#progress-bar-notaC').style.width = "" + (totalC * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#nota_debito').innerText = totalD;
                                                                document.querySelector('#progress-bar-notaD').style.width = "" + (totalD * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#guia_remision').innerText = totalG;
                                                                document.querySelector('#progress-bar-remision').style.width = "" + (totalG * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#liquidacion').innerText = totalL;
                                                                document.querySelector('#progress-bar-liquidacion').style.width = "" + (totalL *
                                                                    100) / 100 + "%";
                                                                var widget = DonutWidget.draw($(".example"), { // these are default options
                                                                    max: 1000,
                                                                    value: total,
                                                                    text: total,
                                                                    caption: "Limite 1000",
                                                                    template: [
                                                                        '<div class="donut-hole" ><span class="donut-filling"></div>',
                                                                        '<div class="donut-bite" data-segment-index="0" ></div>',
                                                                        '<div class="donut-bite" data-segment-index="1"></div>',
                                                                        '<div class="donut-caption-wrapper"><span class="donut-caption"></span></div>'
                                                                    ].join(''),
                                                                    colors: {
                                                                        primary: "#1D38FF",
                                                                        background: "#eee",

                                                                    },
                                                                    size: "large"

                                                                });

                                                            }
                                                        });
                                                    });
                                                </script>
                                                <script>
                                                    $(document).ready(function() {
                                                        let _token = $('meta[name="csrf-token"]').attr('content');
                                                        $.ajax({
                                                            type: "get",
                                                            url: '{{ URL::to('getdial') }}',
                                                            data: {
                                                                _token: _token
                                                            },
                                                            success: function(response) {
                                                                let total_dial = response.length;
                                                                var widget = DonutWidget.draw($(".example"), { // these are default options
                                                                    max: 1000,
                                                                    value: total_dial,
                                                                    text: total_dial,
                                                                    caption: "Limite 1000",
                                                                    template: [
                                                                        '<div class="donut-hole" ><span class="donut-filling"></div>',
                                                                        '<div class="donut-bite" data-segment-index="1" ></div>',
                                                                        '<div class="donut-bite" data-segment-index="1"></div>',
                                                                        '<div class="donut-caption-wrapper"><span class="donut-caption"></span></div>'
                                                                    ].join(''),
                                                                    colors: {
                                                                        primary: "rgba(138,205,232)",
                                                                        background: "#eee",

                                                                    },
                                                                    size: "large"
                                                                });

                                                            }
                                                        });
                                                    });
                                                </script>
                                                <script>
                                                    $(document).ready(function() {
                                                        let _token = $('meta[name="csrf-token"]').attr('content');
                                                        $.ajax({
                                                            type: "get",
                                                            url: '{{ URL::to('progressbarstart') }}',
                                                            data: {
                                                                _token: _token
                                                            },
                                                            success: function(response) {
                                                                let totalF = response.facturas.length;
                                                                let totalR = response.retenciones.length;
                                                                let totalC = response.nota_credito.length;
                                                                let totalD = response.nota_debito.length;
                                                                let totalG = response.guia_remision.length;
                                                                let totalL = response.liquidacion.length;
                                                                document.querySelector('#facturas_bar').innerText = totalF;
                                                                document.querySelector('#progress-bar-facturas').style.width = "" + (totalF * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#retenciones').innerText = totalR;
                                                                document.querySelector('#progress-bar-retenciones').style.width = "" + (totalR *
                                                                    100) / 100 + "%";
                                                                document.querySelector('#nota_credito').innerText = totalC;
                                                                document.querySelector('#progress-bar-notaC').style.width = "" + (totalC * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#nota_debito').innerText = totalD;
                                                                document.querySelector('#progress-bar-notaD').style.width = "" + (totalD * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#guia_remision').innerText = totalG;
                                                                document.querySelector('#progress-bar-remision').style.width = "" + (totalG * 100) /
                                                                    100 + "%";
                                                                document.querySelector('#liquidacion').innerText = totalL;
                                                                document.querySelector('#progress-bar-liquidacion').style.width = "" + (totalL *
                                                                    100) / 100 + "%";

                                                            }
                                                        });
                                                    });
                                                </script>
                                                <tr>
                                                    <th colspan="1">Facturas</th>
                                                    <th colspan="1">
                                                        <div class="progress" style="height: 12px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="background-color:lightgreen;"
                                                                id="progress-bar-facturas">
                                                                <label for="" id="facturas_bar">0</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Retenciones</th>
                                                    <th colspan="1">
                                                        <div class="progress" style="height: 12px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style="background-color:lightgreen;"
                                                                id="progress-bar-retenciones">
                                                                <label for="" id="retenciones">0</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Notas de Creditos</th>
                                                    <th colspan="1">
                                                        <div class="progress" style="height: 12px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style=" background-color:lightgreen;"
                                                                id="progress-bar-notaC">
                                                                <label for="" id="nota_credito">0</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Notas de Debito</th>
                                                    <th colspan="1">
                                                        <div class="progress" style="height: 12px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style=" background-color:lightgreen;"
                                                                id="progress-bar-notaD">
                                                                <label for="" id="nota_debito">0</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Guias de Remision</th>
                                                    <th colspan="1">
                                                        <div class="progress" style="height: 12px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style=" background-color:lightgreen;"
                                                                id="progress-bar-remision">
                                                                <label for="" id="guia_remision">0</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="1">Liquidacion de Compras</th>
                                                    <th colspan="1">
                                                        <div class="progress" style="height: 12px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                aria-valuemin="0" aria-valuemax="100"
                                                                style=" background-color:lightgreen;"
                                                                id="progress-bar-liquidacion">
                                                                <label for="" id="liquidacion">0</label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>


                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Total de ventas</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Producto</th>
                                                    <th>Almacenes</th>
                                                </tr>
                                            <tbody>
                                                <tr>
                                                    <th>12</th>
                                                    <th>Teclado</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>8</th>
                                                    <th>Mouse</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>

                        <br>
                        <div class="col-sm-9 col-6">
                            <div class="description-block">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Network Activities</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">
                                        <div class="row">

                                            <canvas id="revenue-chart-canvas"
                                                style="width:100%;max-width:600px; position: relative; right:-80px;"></canvas>
                                            <script></script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Cuentas por Cobrar</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <select class="form-control select2"
                                                            style="align-content: center; width:120px; border: 2px solid: black;">
                                                            <option selected="selected">Data</option>
                                                        </select>
                                                    </th>
                                                    <th colspan="2">
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1"
                                                            style="align-content: center; width:70px; position: relative; rigth:-20px;">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Facutra</th>
                                                    <th>Cliente</th>
                                                    <th>Ingre Text</th>
                                                    <th>Valor</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>001</th>
                                                    <th>Jose</th>
                                                    <th>Anez</th>
                                                    <th>$300</th>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Grafico 1</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <select class="form-control select2"
                                                            style="align-content: center; width:120px; heigth: 60px; border: 2px solid: black;">
                                                            <option selected="selected">Data</option>
                                                        </select>
                                                    </th>
                                                    <th colspan="1">
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="$20000.00">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">
                                                        <canvas id="mychart-1"
                                                            style="width:350px; heigth:350px; position:relative; left:-95px"></canvas>
                                                        <script></script>
                                                    </th>
                                                </tr>
                                            </thead>

                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Grafico 2</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <select class="form-control select2" style="width: 100%;">
                                                            <option selected="selected">Data</option>
                                                        </select>
                                                    </th>
                                                    <th colspan="2">
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="$20000.00">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">
                                                        <canvas id="mychart-2"
                                                            style="width:400px; heigth:400px; position:relative; left:-95px"></canvas>
                                                        <script></script>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Country Stast</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">
                                        <canvas id="sales-chart" width="400" height="290"></canvas>

                                        <script></script>
                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <div class="card direct-chat direct-chat-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Efectivo</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="height: 300px;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Producto</th>
                                                    <th>Almacenes</th>
                                                </tr>
                                            <tbody>
                                                <tr>
                                                    <th>12</th>
                                                    <th>Teclado</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>8</th>
                                                    <th>Mouse</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Producto</th>
                                                    <th>Almacenes</th>
                                                </tr>
                                            <tbody>
                                                <tr>
                                                    <th>12</th>
                                                    <th>Teclado</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>8</th>
                                                    <th>Mouse</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <th>Pantallas</th>
                                                    <th>Bodega</th>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!-- /.description-block -->
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>

    </div>
    <script src="{{ asset('js/charts.js') }}"></script>




@stop
