@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ route('admin.productos') }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado de Productos</a>
            </span>

            <br><br>

            <form id="formulario" class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.producto.postcrear') }}" enctype="multipart/form-data">

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
                <div class="alert alert-success alert-dismissible fade show text-left" role="alert">
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
                  <div class="panel-title">Crear Producto</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Codigo
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}" required>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Nombre
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Url
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" required>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Precio S/.
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- imagen -->
                      <span class="help-block">
                        Imagen <span>- 500 x 500 px</span>
                      </span>
                      <input type="file" id="imagen" class="input-imagen" name="imagen" />
                      <div class="div-imagen" style="min-height:180px; max-width: 350px;" data-toggle="tooltip" data-placement="top" title="Clic en la imagen para reemplazarla">
                        <img id="imagen_preview" class="img-responsive preview-image" />
                        <span id="imagen_span">Añadir la imagen (500 x 500 px)</span>
                      </div>                                        
                      <!-- fin imagen -->          

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Resumen
                      </span>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="glyphicon glyphicon-list-alt"></i></span>
                        </div>               
                        <textarea class="form-control" id="resumen" name="resumen">{{ old('resumen') }}</textarea>
                      </div>
                      <!-- fin texto multilinea -->                    

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Descripcion
                      </span>
                      <div class="input-group">
                        <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                      </div>
                      <!-- fin texto multilinea -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Informacion Adicional
                      </span>
                      <div class="input-group">
                        <textarea class="form-control" id="adicional" name="adicional">{{ old('adicional') }}</textarea>
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

      $('#nombre').bind('keyup change', function() {
        var nombre = $('#nombre').val();
        nombre =  normalize(nombre);

        console.log(nombre);
        $('#url').val(nombre);
      });
      
      autosize($('textarea'));

      CKEDITOR.config.stylesSet = [
        { name: 'Subtitulo', element: 'h4' },
        { name: 'Parrafo', element: 'p' }
      ];

      //CKEDITOR.config.colorButton_colors = 'C6342D,000000';
      CKEDITOR.config.extraPlugins = 'autogrow';
      CKEDITOR.config.autoGrow_minHeight = 200;

      CKEDITOR.addCss('.cke_editable h4{font-size: 18px;} .cke_editable p{font-size: 14px;} .cke_editable ul li{font-size: 14px;}');

      CKEDITOR.replace('descripcion',
        {
          toolbar :
            [
              { name: 'basicstyles', items : [ 'Bold', 'Italic', 'RemoveFormat' ] },
              { name: 'links', items : [ 'Link', 'Unlink' ] },
              //{ name: 'colors', items: [ 'TextColor' ] },
              { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
              { name: 'styles', items: [ 'Styles' ] },
              //{ name: 'insert', items : [ 'Image' ] },
              { name: 'document', items: [ 'Source' ] }
            ]    
        }
      ); 

      CKEDITOR.replace('adicional',
        {
          toolbar :
            [
              { name: 'basicstyles', items : [ 'Bold', 'Italic', 'RemoveFormat' ] },
              { name: 'links', items : [ 'Link', 'Unlink' ] },
              //{ name: 'colors', items: [ 'TextColor' ] },
              { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
              { name: 'styles', items: [ 'Styles' ] },
              //{ name: 'insert', items : [ 'Image' ] },
              { name: 'document', items: [ 'Source' ] }
            ]    
        }
      ); 

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