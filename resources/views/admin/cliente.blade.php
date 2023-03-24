@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ route('admin.clientes') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado de Clientes</a>
            </span>

            <br><br>

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.cliente.editar', $datos->id) }}" enctype="multipart/form-data">

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <!-- boton -->
              <div class="div-boton">
                <button type="submit" class="btn btn-success" id="guardar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Guardar Datos</button>
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
                  <div class="panel-title">Editar Cliente</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">

                      <div class="mb-3">    
                        @if ($datos->activo == 1)                                
                          <input type="checkbox" name="activo" class="js-switch" checked />&nbsp;&nbsp;<span class="checkbox-text">Activo</span>
                        @else
                          <input type="checkbox" name="activo" class="js-switch" />&nbsp;&nbsp;<span class="checkbox-text">Desactivado</span>
                        @endif
                      </div>

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Email
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $datos->email }}" readonly>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        RUC
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="ruc" name="ruc" value="{{ $datos->ruc }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Razon Social
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $datos->razon_social }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Nombre
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $datos->nombre }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Apellidos
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $datos->apellidos }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        DNI
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="dni" name="dni" value="{{ $datos->dni }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Telefono fijo
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $datos->telefono }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Celular
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ $datos->celular }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Ciudad
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $datos->ciudad }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Distrito
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="distrito" name="distrito" value="{{ $datos->distrito }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Direccion
                      </span>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="glyphicon glyphicon-list-alt"></i></span>
                        </div>               
                        <textarea class="form-control" id="direccion" name="direccion">{{ $datos->direccion }}</textarea>
                      </div>
                      <!-- fin texto multilinea -->  

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

      var changeCheckbox = document.querySelector('.js-switch');

      changeCheckbox.onchange = function() {

        if(changeCheckbox.checked == 0) {
          $('.checkbox-text').html('Desactivado');
        }
        else{
          $('.checkbox-text').html('Activo');
        }
      };

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