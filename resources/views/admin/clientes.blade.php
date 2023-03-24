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
                <div class="panel-title">Clientes</div>
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

                  <br>

                  <table id="table-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>                        
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Fecha Registro</th>
                        <th>Activo</th>
                        <th>Editar</th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach ($clientes as $dato)                      
                        <tr>
                          <td>{{ $dato->email }}</td>
                          <td>{{ $dato->nombre }} {{ $dato->apellidos }}</td>
                          <td>{{ date('d-M-Y', strtotime($dato->created_at)) }}</td>

                          @if ($dato->activo == 1)
                            <td><span class="badge badge-success">Activo</span></td>
                          @else
                            <td><span class="badge badge-warning">Desactivado</span></td>
                          @endif
                          
                          <td><a href="{{ route('admin.cliente', $dato->id) }}" class="editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
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

@section('script')

  <script type="text/javascript">
    $(document).ready(function() {
      
      $('#table-responsive').DataTable({
        responsive: true,
        'pageLength': 25,
        'order': [[1, 'asc']],
        'columnDefs': [
          { responsivePriority: 1, targets: 1 },
          { responsivePriority: 2, targets: 3 },
          { responsivePriority: 3, targets: 4 },
          { responsivePriority: 4, targets: 0 },
          { responsivePriority: 5, targets: 2 }
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

    });
  </script>

@endsection