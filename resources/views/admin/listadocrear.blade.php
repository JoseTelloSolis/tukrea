@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ route('admin.listado') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado</a>
            </span>

            <br><br>

            <form id="formulario" class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.listado.crear') }}" enctype="multipart/form-data">

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
                  <div class="panel-title">Crear Listado Escolar</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-6">                  

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Elegir colegio
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <select class="form-control" id="id_colegio" name="id_colegio">
                          @forelse ($colegios as $dato)
                            <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                          @empty
                            <option value="">No hay colegios ingresados</option>
                          @endforelse
                        </select>
                      </div>
                      <!-- fin texto linea simple -->  

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Elegir nivel
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <select class="form-control" id="id_nivel" name="id_nivel">
                          @forelse ($niveles as $dato)
                            <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                          @empty
                            <option value="">No hay niveles ingresados</option>
                          @endforelse
                        </select>
                      </div>
                      <!-- fin texto linea simple -->  

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Elegir grado
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <select class="form-control" id="id_grado" name="id_grado">
                          @forelse ($grados as $dato)
                            <option value="{{ $dato->id }}">{{ $dato->nombre }}</option>
                          @empty
                            <option value="">No hay grados ingresados</option>
                          @endforelse
                        </select>
                      </div>
                      <!-- fin texto linea simple -->   

                    </div>

                    <div id="container-productos" class="col-lg-6"> 

                      <button id="add-producto" class="add-producto btn btn-primary" type="button"><i class="fa fa-plus"></i> Añadir producto</button>

                      <textarea id="lista-productos" name="lista_productos" style="display:none;"></textarea>

                      <hr>

                      <div id="div-producto" class="row div-producto mb-3">
                        <div class="col-sm-7">
                          <select class="form-control id-producto">
                            @foreach ($productos as $dato)
                              <option value="{{ $dato->id }}">{{ $dato->codigo }} - {{ $dato->nombre }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <input type="number" class="form-control cantidad" placeholder="Cantidad">
                        </div>
                        <div class="col-sm-1">
                          <a href="#" class="remove-producto"><i class="fa fa-close"></i></a>
                        </div>
                      </div>

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

      $('#formulario').submit(function(e) {

        e.preventDefault();

        jsonObj = [];

        $('.div-producto').each(function(){

          var idProducto = $(this).find('.id-producto').val();
          var cantidad = $(this).find('.cantidad').val();

          item = {}
          item ['id_producto'] = idProducto;
          item ['cantidad'] = cantidad;

          jsonObj.push(item);
        });

        var jsonString = JSON.stringify(jsonObj);

        $('#lista-productos').val(jsonString);

        $(this).unbind('submit').submit();
      });

      $('#add-producto').click(function(){
        var div = $('#div-producto').clone();

        div.css('display', 'none');
        $('#container-productos').append(div); 
        div.show(600);
      });

      $('#container-productos').on('click', '.remove-producto', function(e){
        e.preventDefault();

        var conteo = $('.div-producto').length;

        if(conteo > 1) {
          var padre = $(this).parent().parent();

          padre.addClass('removed-item').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            this.remove();
          });
        }
        
      });

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