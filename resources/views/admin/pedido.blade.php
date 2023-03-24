@extends('admin.plantilla')

@section('contenido')
  
  <style>
    p, .card-body a {
      font-size: 16px;
    }

    a.btn-danger {
      color: #ffffff;
    }

    .rojo {
      color: #ff0000;
    }
  </style>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ url()->previous() }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado de Pedidos</a>
            </span>

            <br><br>

            <form id="formulario" class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.voucher.rechazar', $datos->id) }}" enctype="multipart/form-data">

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <!-- boton -->
              <div class="div-boton">
                <!--<button type="submit" class="btn btn-success" id="guardar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Guardar Datos</button>-->

                <span id="mensaje-upload"></span>
              </div>
              <!-- fin boton --> 

              @if (session('mensajeError'))
                <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
                  {{ session('mensajeError') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                      &times;
                    </span>
                  </button>
                </div>
              @endif

              @if (session('mensaje'))
                <div class="alert alert-success alert-dismissible fade show text-left"
                role="alert">
                  {{ session('mensaje') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                      &times;
                    </span>
                  </button>
                </div>
              @endif
              
              <!--contenido -->
              <div class="card card-primary">
      
                <div class="card-header">
                  <div class="panel-title">Pedido del dia {{ date('d/m/yy', strtotime($datos->created_at)) }}</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">

                    <div class="col-md-8 pb-5 mb-5">

                      <h2>Detalle del pedido</h2>

                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                          </tr>
                        </thead>
                        <tbody id="detalle-pedido">
                          @forelse($detalle as $dato)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $dato->codigo }}</td>
                              <td>{{ $dato->nombre }}</td>
                              <td>{{ $dato->cantidad }}</td>
                              <td>S/. {{ $dato->precio_t }}</td>
                            </tr>
                          @empty
                            <td colspan="5">No se encontraron productos</td>
                          @endforelse
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                            <td><span class="monto" id="monto">S/. {{ $datos->total }}</span></td>
                          </tr>
                          <tr>
                            <td colspan="4" class="text-right"><strong>Costo de envío</strong></td>
                            <td><span class="monto" id="monto">S/. {{ $datos->delivery }}</span></td>
                          </tr>
                          <tr>
                            <td colspan="4" class="text-right"><strong>Total del pedido</strong></td>
                            <td><span class="monto" id="monto">S/. {{ number_format(($datos->total + $datos->delivery), 2) }}</span></td>
                          </tr>
                        </tfoot>
                      </table>

                    </div>

                    <div class="col-md-4">

                      <h2>Informacion del cliente</h2>

                      <p><strong>Nombre:</strong> {{ $datos->nombre }} {{ $datos->apellidos }}</p>
                      <p><strong>Email:</strong> {{ $datos->email }}</p>
                      <p><strong>Telefono Fijo:</strong> {{ $datos->telefono }}</p>
                      <p><strong>Celular:</strong> {{ $datos->celular }}</p>
                      <p><strong>Departamento:</strong> {{ $datos->departamento }}</p>
                      <p><strong>Provincia:</strong> {{ $datos->provincia }}</p>
                      <p><strong>Distrito:</strong> {{ $datos->distrito }}</p>
                      <p><strong>Direccion:</strong> {{ $datos->direccion }}</p>

                      <br>
                      <h2>Datos de facturacion</h2>

                      <p><strong>Tipo:</strong> {{ $datos->boleta_factura }}</p>

                      @if ($datos->boleta_factura == 'factura')
                        <p><strong>Ruc:</strong> {{ $datos->ruc }}</p>
                        <p><strong>Razon social:</strong> {{ $datos->razon_social }}</p>
                      @endif

                      @if ($datos->tipo == 'deposito')
                        <p><strong>Tipo de pago:</strong> Deposito bancario</p>

                        <br>

                        @if ($datos->voucher == '')
                          <p class="rojo"><strong>Esperando voucher del cliente</strong></p>
                        @else
                          <a href="{{ asset($datos->voucher) }}" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> Ver voucher</a>

                          <p class="mt-4">
                            <a class="btn btn-danger btn-md mb-2" data-toggle="collapse" href="#collapseRechazarVoucher" role="button" aria-expanded="false" aria-controls="collapseRechazarVoucher"><span class="glyphicon glyphicon-remove"></span> Rechazar Voucher</a>
                          </p>

                          <div class="collapse" id="collapseRechazarVoucher">
                            <div class="card card-body">
                              
                              <!-- texto multilinea -->
                              <span class="help-block">
                                Motivo del rechazo
                              </span>
                              <div class="input-group">                                              
                                <textarea class="form-control" id="motivo" name="motivo" required></textarea>
                              </div>
                              <!-- fin texto multilinea -->  

                              <button type="submit" class="btn btn-success btn-md mb-2 full"><span class="glyphicon glyphicon-remove"></span>  Rechazar</button> 

                            </div>
                          </div>

                        @endif

                      @else
                        <p><strong>Tipo de pago:</strong> Pago con tarjeta</p>
                      @endif

                    </div>

                  </div>   

                
                </div>

              </div>
              <!-- end contenido -->
            </form>

          </div>

        </div>

      </div>
    </div>

  </div>
@endsection

@section('script')

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <script src="{{ asset('assets_admin/jscolor/jscolor.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      
    });
  </script>

@endsection