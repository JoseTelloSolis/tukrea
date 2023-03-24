@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ route('admin.colegios') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado</a>
            </span>

            <br><br>

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.colegios.crear') }}" enctype="multipart/form-data">

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <!-- boton -->
              <div class="div-boton">
                <button type="submit" class="btn btn-success" id="guardar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Guardar Datos</button>
              </div>
              <!-- fin boton --> 

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

              @if (session('mensajeError'))
                <div class="alert alert-danger alert-dismissible fade show text-left"
                role="alert">
                  {{ session('mensajeError') }}
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
                  <div class="panel-title">Crear Colegio</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">                    

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Nombre
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                      </div>
                      <!-- fin texto linea simple -->                      

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

  <script type="text/javascript">

    $(document).ready(function() {

      function readURL(input, target) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          var image_target = $(target);
          reader.onload = function (e) {
            image_target.attr('src', e.target.result).show();
          };
          reader.readAsDataURL(input.files[0]);
        }
      }

      $(".div-imagen").click(function(){
        $(this).prev('.input-imagen').trigger('click');
      });

      $(".input-imagen").on("change",function(){
        id = $(this).attr('id');
        readURL(this, "#"+id+"_preview");
        $("#"+id+"_span").html('');
      });

    });
  </script>

@endsection