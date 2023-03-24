@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ route('admin.slider') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado de Imagenes del Slider</a>
            </span>

            <br><br>

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.slider.crear') }}" enctype="multipart/form-data">

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
                  <div class="panel-title">Crear Imagen</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">                    

                      <!-- imagen -->
                      <span class="help-block">
                        Imagen <span>- 1140 x 420 px</span>
                      </span>
                      <input type="file" id="imagen" class="input-imagen" name="imagen" />
                      <div class="div-imagen" style="min-height:180px; max-width: 450px;" data-toggle="tooltip" data-placement="top" title="Clic en la imagen para reemplazarla">
                        <img id="imagen_preview" class="img-responsive preview-image" />
                        <span id="imagen_span">Añadir la imagen (1140 x 420 px)</span>
                      </div>                                        
                      <!-- fin imagen -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Enlace URL <span>- Si se deja en blanco el botón "Más información" no aparecerá</span>
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
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