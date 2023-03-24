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
                <div class="panel-title">Grupos</div>
              </div>  
              
              <div class="card-body">

                <div class="table-responsive">

                  <div class="div-tabla-boton">
                    <a href="javascript:void(0)" id="mostrar-actualizar" class="btn btn-success btn-md mb-2"><i class="fa fa-refresh"></i> Actualizar desde la ERP</a>

                    <form class="form-inline" type="GET" action="?">
                      <div class="form-group mb-2">
                        <input type="text" class="form-control" name="buscar" placeholder="Buscar...">
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                    </form>
                  </div>

                  <br>

                  @if( Request::get('actualizado'))
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

                  <table id="table-responsive" class="table table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Sub-Familia</th>
                        <th>Activo</th>
                        <th>Editar</th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach ($datos as $dato)                        
                        <tr> 
                          <td>{{ $dato->nombre }}</td>
                          <td>{{ $dato->nombre_subfamilia }}</td>

                          @if ($dato->activo == 1)
                            <td><span class="badge badge-success">Activo</span></td>
                          @else
                            <td><span class="badge badge-danger">Desactivado</span></td>
                          @endif

                          <td><a href="{{ route('admin.grupo', $dato->id) }}" class="editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
                        </tr>
                      @endforeach

                    </tbody>                          
                  
                  </table>

                  <div class="div-pagination">
                    {{ $datos->links() }}
                  </div>

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
        <p>¿Esta seguro que desea actualizar?</p>
        <p>Esta operacion puede tardar unos minutos</p>
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

      $('#mostrar-actualizar').click(function(e) {
        e.preventDefault();
        $('#modal-actualizar').modal('show');
      });

      $('#actualizar').click(function(e) {

        e.preventDefault();

        $.ajax({
          url: '{{ route("admin.grupos.actualizar") }}',
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