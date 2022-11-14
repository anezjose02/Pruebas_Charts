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
                                            <select class="form-control form-control-sm select2" style="align-content: center; width:120px; heigth: 60px; border: 2px solid: black;">
                                                <option selected="selected">Data</option>
                                            </select>
                                        </th>
                                        <th>
                                            <label for="" style="position: relative; rigth:20px;">$ 20000.00</label>
                                        </th>
                                    </tr>
                                    <tr>
                                      <th>Efectivo:</th>
                                      <th>$ 4500.00</th>
                                    </tr>
                                    <tr>
                                        <th>Transferencia</th>
                                        <th>$ 14500.00</th>
                                    </tr>
                                    <tr>
                                        <th>Tarjeta de Credito</th>
                                        <th>$ 3500.00</th>
                                    </tr>
                                    <tr>
                                        <th>Tarjeta de Debito</th>
                                        <th>$ 8500.00</th>
                                    </tr>
                                    <tr>
                                        <th>Credito</th>
                                        <th>$ 24500.00</th>
                                    </tr>
                                  </thead>
                              </table>
                            </div>
                            
                          </div>
                    </div>
                    </h6>
                    
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
                                        <input type="date" name="from" id="from" style="align-content: center; width:120px; border: 2px solid: black;">
                                    </th>
                                    <th colspan="1">
                                        <label for="">Hasta</label> <br>
                                        <input type="date" name="to" id="to" style="align-content: center; width:120px; border: 2px solid: black;">
                                    </th>
                                      <th colspan="2" rowspan="10">
                                        <!-- jquery cdn -->
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                        <!-- jquery knob cdn -->
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
                                        <input type="text" value="" class="dial" id="dial" name="dial">
                                        <script type="text/javascript">
                                           $(document).ready(function () {
                                            let _token   = $('meta[name="csrf-token"]').attr('content');
                                            $.ajax({
                                              type: "get",
                                              url: '{{URL::to('getdial')}}',
                                              data:  {_token: _token},
                                              success: function (response) {
                                                console.log('esta es la respuesta;', response);
                                                let total = response.length;
                                                console.log('this is count for dial', total);
                                                $('#dial').val(total);
                                              }
                                            });
                                           });
                                        </script>
                                          
                                      </th>
                                    </tr>
                                    @php
                                        use Illuminate\Support\Facades\DB;
                                        $retenciones = DB::table('retenciones')->count();
                                        $facturascompensacions = DB::table('facturascompensacions')->count();
                                        $notacreditos = DB::table('notacreditos')->count();
                                        $notadebitos = DB::table('notadebitos')->count();
                                        $guiaremisions = DB::table('guiaremisions')->count();
                                        $liquidacioncompras = DB::table('liquidacioncompras')->count();
                                    @endphp
                                    
                                    <tr>
                                      <th colspan="1">Facturas</th>
                                      <th colspan="1">
                                        <div class="progress" style="height: 12px;">
                                          <div class="progress-bar" role="progressbar"
                                          aria-valuemin="0" aria-valuemax="100" style="width:{{ $facturascompensacions }}%; background-color:lightgreen;">
                                            <label for="">{{ $facturascompensacions }}</label>
                                          </div>
                                        </div>
                                      </th>
                                    </tr>
                                    <tr>
                                      <th colspan="1">Retenciones</th>
                                      <th colspan="1">
                                        <div class="progress" style="height: 12px;">
                                          <div class="progress-bar" role="progressbar"
                                          aria-valuemin="0" aria-valuemax="100" style="width:{{ $retenciones }}%; background-color:lightgreen;">
                                            <label for="">{{ $retenciones }}</label>
                                          </div>
                                        </div>
                                      </th>
                                    </tr>
                                    <tr>
                                      <th colspan="1">Notas de Creditos</th>
                                      <th colspan="1">
                                        <div class="progress" style="height: 12px;">
                                          <div class="progress-bar" role="progressbar"
                                          aria-valuemin="0" aria-valuemax="100" style="width:{{ $notacreditos }}%; background-color:lightgreen;">
                                            <label for="">{{ $notacreditos }}</label>
                                          </div>
                                        </div>
                                      </th>
                                  </tr>
                                  <tr>
                                    <th colspan="1">Notas de Debito</th>
                                    <th colspan="1">
                                      <div class="progress" style="height: 12px;">
                                        <div class="progress-bar" role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100" style="width:{{ $notadebitos }}%; background-color:lightgreen;">
                                          <label for="">{{ $notadebitos }}</label>
                                        </div>
                                      </div>
                                    </th>
                                </tr>
                                <tr>
                                  <th colspan="1">Guias de Remision</th>
                                  <th colspan="1">
                                    <div class="progress" style="height: 12px;">
                                      <div class="progress-bar" role="progressbar"
                                      aria-valuemin="0" aria-valuemax="100" style="width:{{ $guiaremisions }}%; background-color:lightgreen;">
                                        <label for="">{{ $guiaremisions }}</label>
                                      </div>
                                    </div>
                                  </th>
                              </tr>
                              <tr>
                                <th colspan="1">Liquidacion de Compras</th>
                                <th colspan="1">
                                  <div class="progress" style="height: 12px;">
                                    <div class="progress-bar" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" style="width:{{ $liquidacioncompras }}%; background-color:lightgreen;">
                                      <label for="">{{ $liquidacioncompras }}</label>
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
                               
                              <canvas id="revenue-chart-canvas" style="width:100%;max-width:600px; position: relative; right:-80px;"></canvas>
                              <script>
                                                              
                              </script>
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
                                        <select class="form-control select2" style="align-content: center; width:120px; border: 2px solid: black;">
                                            <option selected="selected">Data</option>
                                        </select>
                                    </th>
                                    <th colspan="2">
                                        <input type="text" class="form-control" id="exampleInputEmail1" style="align-content: center; width:70px; position: relative; rigth:-20px;" >
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
                               
                              <table class="table" >
                                <thead>
                                  <tr>
                                    <th colspan="2">
                                        <select class="form-control select2" style="align-content: center; width:120px; heigth: 60px; border: 2px solid: black;">
                                            <option selected="selected">Data</option>
                                        </select>
                                    </th>
                                    <th colspan="1">
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="$20000.00">
                                    </th>
                                  </tr>
                                  <tr>
                                    <th colspan="3">
                                      <canvas id="mychart-1" style="width:350px; heigth:350px; position:relative; left:-95px"></canvas>
                                      <script>
                                        
                                        </script>
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
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="$20000.00">
                                    </th>
                                  </tr>
                                  <tr>
                                    <th colspan="3">
                                      <canvas id="mychart-2" style="width:400px; heigth:400px; position:relative; left:-95px"></canvas>
                                      <script>
                                        
                                        </script>
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
                             
                              <script>
                                
                                </script>
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
