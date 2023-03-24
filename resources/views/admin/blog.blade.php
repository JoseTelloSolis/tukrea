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
                <div class="panel-title">Blog</div>
              </div>  
              
              <div class="card-body">

                <div class="table-responsive">

                  <div class="div-tabla-boton">
                    <a href="{{ route('admin.blog.crear') }}" class="btn btn-success btn-md mb-2"><i class="fa fa-file"></i> Nueva Entrada de blog</a>
                  </div> 

                  <br>
                            
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
                        <th><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></th>
                        <th>Titulo</th>
                        <th>Creado el</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach ($blog as $dato)                        
                        <tr> 
                          @if ($dato->imagen == '')
                            <td><span class="badge badge-danger">Sin foto</span></td>
                          @else
                            <td><img src="{{ asset($dato->imagen) }}" style="max-width:50px;margin:0 auto;"></td>
                          @endif                                                   

                          <td>{{ $dato->titulo }}</td>
                          
                          <td>{{ $dato->created_at->format('d/m/Y') }}</td>

                          <td><a href="{{ route('admin.blog.editar', $dato->id) }}" class="editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
                          <td><a href="{{ route('admin.blog.eliminar', $dato->id) }}" class="editar boton-editar eliminar" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                      @endforeach

                    </tbody>                          
                  
                  </table>

                  <div class="div-pagination">
                    {{ $blog->links() }}
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

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {

      $('#table-responsive').DataTable({
        responsive: true,
        'pageLength': 25,
        'order': [[4, 'asc']],
        'columnDefs': [
          { responsivePriority: 1, targets: 1 },
          { responsivePriority: 2, targets: 3 },
          { responsivePriority: 3, targets: 4 },
          { responsivePriority: 4, targets: 2 },
          { responsivePriority: 5, targets: 3 }
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

      $('#table-responsive').on('click', '.eliminar', function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        var confirmacion = confirm("Esta por eliminar una entrada de blog. ¿Aún desea hacerlo?");
        
        if(confirmacion == true) {
          window.location.href = url;
        }
      });

    });
  </script>
@endsection