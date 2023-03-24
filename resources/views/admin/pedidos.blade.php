@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">
              
            <!--contenido -->
            <div class="card card-primary">
    
              <div class="card-header">
                <div class="panel-title">Pedidos</div>
              </div>  
              
              <div class="card-body">

               <div class="table-responsive">
                            
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

                  <div id="div-alerta">
                    
                  </div>

                  <br>

                  <table id="table-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Voucher</th>
                        <th>Detalle</th>
                      </tr>
                    </thead>

                    <tbody id="listado">      

                      @foreach($datos as $dato)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $dato->nombre }} {{ $dato->apellidos }}</td>
                          <td>S/. {{ $dato->total }}</td>
                          <td>{{ date('d/m/yy', strtotime($dato->created_at)) }}</td>

                          <td>
                            <select data-id="{{ $dato->id }}" class="form-control cambiar-estado" style="width:auto;">
                              @if($dato->estado == 'Pagado - Pendiente de entrega')
                                <option value="Pendiente de pago">Pendiente de pago</option>
                                <option value="Pendiente de confirmacion">Pendiente de confirmacion</option>
                                <option value="Pagado - Pendiente de entrega" selected>Pagado - Pendiente de entrega</option>
                                <option value="Pagado - Entregado">Pagado - Entregado</option>
                              @elseif($dato->estado == 'Pagado - Entregado')
                                <option value="Pendiente de pago">Pendiente de pago</option>
                                <option value="Pendiente de confirmacion">Pendiente de confirmacion</option>
                                <option value="Pagado - Pendiente de entrega">Pagado - Pendiente de entrega</option>
                                <option value="Pagado - Entregado" selected>Pagado - Entregado</option>
                              @elseif($dato->estado == 'Pendiente de pago')
                                <option value="Pendiente de pago" selected>Pendiente de pago</option>
                                <option value="Pendiente de confirmacion">Pendiente de confirmacion</option>
                                <option value="Pagado - Pendiente de entrega">Pagado - Pendiente de entrega</option>
                                <option value="Pagado - Entregado">Pagado - Entregado</option>
                              @elseif($dato->estado == 'Pendiente de confirmacion')
                                <option value="Pendiente de pago">Pendiente de pago</option>
                                <option value="Pendiente de confirmacion" selected>Pendiente de confirmacion</option>
                                <option value="Pagado - Pendiente de entrega">Pagado - Pendiente de entrega</option>
                                <option value="Pagado - Entregado">Pagado - Entregado</option>
                              @endif                             
                            </select>
                          </td>

                          
                          @if ($dato->tipo == 'deposito')
                            @if ($dato->voucher != '')
                              <td><a href="{{ route('admin.pedido', $dato->id) }}" class="boton-editar" title="Ver Voucher"><span class="glyphicon glyphicon-file"></span></a></td>
                            @else
                              <td><span class="badge badge-danger">Voucher pendiente</span></td>
                            @endif
                          @else
                            <td><span class="badge badge-success">Pago con tarjeta</span></td>
                          @endif

                          <td><a href="{{ route('admin.pedido', $dato->id) }}" class="boton-editar" title="Ver Detalle"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        </tr>
                      @endforeach

                    </tbody>                          
                  
                  </table>
                </div>
              
              </div>

            </div>
            <!-- end contenido -->

          </div>
        </div>

      </div>
    </div>

  </div>

  <!-- Detalle 1 -->
  <div class="modal fade" id="detalle" tabindex="-1" role="dialog" aria-labelledby="detalle1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detalleLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-sm-12">
              <h2 class="btn-primary p-2">Informacion del cliente</h2>
            </div>
            <div class="col-md-6">              
              <p id="cliente-nombre"></p>
              <p id="cliente-email"></p>
              <p id="cliente-telefono"></p>
              <p id="cliente-celular"></p>
            </div>
            <div class="col-md-6">
              <p id="cliente-departamento"></p>
              <p id="cliente-provincia"></p>
              <p id="cliente-distrito"></p>
              <p id="cliente-direccion"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <h2 class="btn-primary p-2">Datos de facturación</h2>
            </div>
            <div class="col-md-6">              
              <p id="cliente-boleta-factura"></p>
              <p id="cliente-ruc"></p>
            </div>
            <div class="col-md-6">
              <p>&nbsp;</p>
              <p id="cliente-razon-social"></p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <h2 class="btn-primary p-2">Detalle del pedido</h2>
            </div>
            <div class="col-md-12">              
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
                  
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4" class="text-right"><strong>Total del pedido</strong></td>
                    <td><span class="monto" id="monto"></span></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

        </div>        
      </div>
    </div>
  </div>

@endsection

@section('script')

  <script type="text/javascript">
    $(document).ready(function() {
      
      $('#table-responsive').DataTable({
        responsive: true,
        'pageLength': 25,
        'order': [[1, 'asc']],
        'columnDefs': [
          { responsivePriority: 1, targets: 2 }
        ],
        'language': {
          'lengthMenu': 'Mostrar _MENU_ por pagina',
          'zeroRecords': 'No encontramos su busqueda - lo sentimos',
          'info': 'Mostrando pagina _PAGE_ de _PAGES_',
          'infoEmpty': 'No se encontraron elementos',
          'infoFiltered': '(filtrados de _MAX_ total de registros)',
          'search': 'Buscar:',
          'paginate': {
            'first':      'Primero',
            'last':       'Ultimo',
            'next':       'Siguiente',
            'previous':   'Anterior'
          }
        }
      });

      $('.cambiar-estado').change(function() {
        var id = $(this).attr('data-id');
        var estado = $(this).val();

        var parametros = {
          'id' : id,
          'estado' : estado
        };

        $.ajax({
          data:  parametros,
          url:   '{{ route("admin.pedidos.estado") }}',
          type: 'GET',
          success:  function(datos) {
            console.log(datos);
            if(datos == 'ok'){
              $('#div-alerta').html(`
                <div id="alerta-estado" class="alert alert-success alert-dismissible fade show text-left" role="alert">
                  Estado del pedido actualizado
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                      &times;
                    </span>
                  </button>
                </div>
              `);
            }
          }
        });
      });

    });
  </script>

@endsection