@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ route('admin.categorias') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado de Categorias</a>
            </span>

            <br><br>

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.categorias.crear') }}" enctype="multipart/form-data">

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
                  <div class="panel-title">Crear Categoria</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">

                      <div class="mb-3">    
                        <input type="checkbox" name="activo" class="js-switch" checked />&nbsp;&nbsp;<span class="checkbox-text">Activo</span>
                      </div>

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Nombre
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Url - <span>sin espacios en blanco</span>
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" required>
                      </div>
                      <!-- fin texto linea simple --> 

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Descripcion
                      </span>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="glyphicon glyphicon-list-alt"></i></span>
                        </div>               
                        <textarea class="form-control" id="texto" name="texto">{{ old('texto') }}</textarea>
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
    var normalize = (function() {
      var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
          to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
          mapping = {};
     
      for(var i = 0, j = from.length; i < j; i++)
        mapping[from.charAt(i)] = to.charAt(i);
     
      return function(str) {
        var ret = [];
        for(var i = 0, j = str.length; i < j; i++) {
          var c = str.charAt(i);
          if(mapping.hasOwnProperty(str.charAt(i)))
            ret.push(mapping[c]);
          else
            ret.push(c);
        }      
        return ret.join( '' ).replace( /[^-A-Za-z0-9]+/g, '-' ).toLowerCase();
      }
     
    })();

    $(document).ready(function() {

      autosize($('textarea'));

      var url = $('#url').val();

      if(url == ''){
        var nombre = $('#nombre').val();
        nombre =  normalize(nombre);
        $('#url').val(nombre);
      }  

      $('#nombre').bind('keyup change', function() {
        var nombre = $('#nombre').val();
        nombre =  normalize(nombre);

        console.log(nombre);
        $('#url').val(nombre);
      });    

      var changeCheckbox = document.querySelector('.js-switch');

      changeCheckbox.onchange = function() {

        if(changeCheckbox.checked == 0) {
          $('.checkbox-text').html('Desactivado');
        }
        else{
          $('.checkbox-text').html('Activo');
        }
      };

    });
  </script>

@endsection