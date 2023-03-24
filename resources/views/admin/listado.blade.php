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
                <div class="panel-title">Listado Escolar</div>
              </div>  
              
              <div class="card-body">

               <div class="table-responsive">

                  <a href="{{ route('admin.listado.crear') }}" class="btn btn-success btn-md"><i class="fa fa-file"></i> Añadir Nuevo</a>
                            
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

                  <br><br>

                  <table id="table-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Colegio</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Productos</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>

                      @forelse ($datos as $dato)
                        <tr>
                          <td>{{ $loop->iteration }}</td>   
                          <td>{{ $dato->nombre_colegio }}</td>
                          <td>{{ $dato->nombre_nivel }}</td>
                          <td>{{ $dato->nombre_grado }}</td>
                          @if($dato->conteo > 0)
                            <td>{{ $dato->conteo }}</td>
                          @else
                            <td><span class="badge badge-danger">Sin productos</span></td>
                          @endif

                          <td>
                            <a href="{{ route('admin.listado.editar', $dato->id) }}" class="btn-admin editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                          </td>
                          <td>
                            <a href="{{ route('admin.listado.eliminar', $dato->id) }}" class="btn-admin eliminar boton-eliminar" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                          </td>

                        </tr>
                      @empty
                        <tr>
                          <td colspan="4">Aun no se ingresaron datos...</td>
                        </tr>
                      @endforelse

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

@section('script')

  <script type="text/javascript">
    $(document).ready(function() {
      
      $('#table-responsive').DataTable({
        responsive: true,
        'pageLength': 25,
        'order': [[0, 'asc']],
        'columnDefs': [
          { responsivePriority: 1, targets: 1 },
          { responsivePriority: 2, targets: 2 },
          { responsivePriority: 3, targets: 3 },
          { responsivePriority: 4, targets: 0 }
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

      $('.table').on('click', '.eliminar', function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        var confirmacion = confirm("Esta por eliminar una imagen. ¿Aún desea hacerlo?");
        
        if(confirmacion == true) {
          window.location.href = url;
        }
      });

    });
  </script>

@endsection