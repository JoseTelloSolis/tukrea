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
                <div class="panel-title">Productos</div>
              </div>  
              
              <div class="card-body">

                <div class="table-responsive">

                  <div class="div-tabla-boton">
                    <a href="javascript:void(0)" id="mostrar-actualizar" class="btn btn-success btn-md mb-2"><i class="fa fa-refresh"></i> Actualizar desde la ERP</a>
                  </div>                  

                  <br>

                  @if (Request::get('actualizado'))
                    <div class="alert alert-success alert-dismissible fade show text-left"
                    role="alert">
                      Datos actualizados correctamente
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

                  <br>

                  <table id="table-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Stock</th>
                        <th>Foto</th>
                        <th>Activo</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach($datos as $dato)                                             
                        <tr>
                          <td>{{ $dato->nombre }}</td>
                          <td>{{ $dato->codigo }}</td>
                          <td>{{ $dato->stock }}</td>

                          @if ($dato->imagen != '')
                            <td><img src="{{ asset($dato->imagen) }}" style="max-width: 80px;"></td>
                          @else
                            <td><span class="badge badge-danger">Sin foto</span></td>
                          @endif   

                          @if ($dato->activo == 1)
                            <td><span class="badge badge-success">Activo</span></td>
                          @else
                            <td><span class="badge badge-danger">Desactivado</span></td>
                          @endif                    

                          <td><a href="{{ route('admin.producto', $dato->id) }}" class="editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
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
@endsection

<!-- Modal -->
<div class="modal" id="modal-actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar datos desde la ERP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro que desea actualizar?<br>Esta operacion puede tardar unos minutos</p>
        <p>Si no visualiza un producto, aségurese que las secciones de familias, sub familias y grupos estén también actualizadas</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="actualizar" class="btn btn-primary"><i class="fa fa-refresh"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal" id="modal-loader" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Actualizando</h5>
      </div>
      <div class="modal-body text-center">
        <p>No cierre la pagina mientras el proceso termina...</p>
        <img src="{{ asset('assets_admin/img/loader.gif') }}" class="modal-loader-icon">
      </div>      
    </div>
  </div>
</div>

@section('script')

  <script type="text/javascript">

    $(document).ready(function() {
      
      $('#table-responsive').DataTable({
        responsive: true,
        'pageLength': 25,
        'order': [[4, 'asc']],
        'columnDefs': [
          { responsivePriority: 1, targets: 0 },
          { responsivePriority: 2, targets: 4 },
          { responsivePriority: 3, targets: 5 },
          { responsivePriority: 4, targets: 1 },
          { responsivePriority: 5, targets: 2 },
          { responsivePriority: 6, targets: 3 }
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

      $('#mostrar-actualizar').click(function(e) {
        e.preventDefault();
        $('#modal-actualizar').modal('show');
      });

      $('#actualizar').click(function(e) {

        e.preventDefault();

        $.ajax({
          url: '{{ route("admin.productos.actualizar") }}',
          type: 'GET',   
          success: function(datos) {
            console.log(datos);

            $('#modal-loader').modal('hide');

            if(datos == 'ok') {
              window.location.replace(window.location.href + "?actualizado=ok")
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          },
          beforeSend: function() {
            $('#modal-actualizar').modal('hide');
            $('#modal-loader').modal('show');
          }            
        });

      });

    });
  </script>

@endsection