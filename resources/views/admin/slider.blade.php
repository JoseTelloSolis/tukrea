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
                <div class="panel-title">Slider</div>
              </div>  
              
              <div class="card-body">

               <div class="table-responsive">

                  <a href="{{ route('admin.slider.crear') }}" class="btn btn-success btn-md"><i class="fa fa-file"></i> Añadir Nuevo</a>
                            
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
                        <th>Imagen</th>
                        <th>Url</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>

                      @forelse ($datos as $dato)
                        <tr>  
                          <td><img src="{{ asset($dato->imagen) }}" style="max-width: 250px;"></td>
                          <td>{{ $dato->url }}</td> 

                          <td>
                            <a href="{{ route('admin.slider.editar', $dato->id) }}" class="editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                          </td>
                          <td>
                            <a href="{{ route('admin.slider.eliminar', $dato->id) }}" class="eliminar boton-eliminar" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
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