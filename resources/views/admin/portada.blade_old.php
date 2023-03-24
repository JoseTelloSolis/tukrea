@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.portada.editar') }}" enctype="multipart/form-data">

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
              
              <!--contenido -->
              <div class="card card-primary">
      
                <div class="card-header">
                  <div class="panel-title">Portada</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">

                      <!-- imagen -->
                      <span class="help-block">
                        Imagen Principal <span>- tamaño recomendado 1800 x 920 px</span>
                      </span>
                      <input type="file" id="imagen" class="input-imagen" name="imagen" />
                      <div class="div-imagen" style="min-height:200px;" data-toggle="tooltip" data-placement="top" title="Clic en la imagen para reemplazarla">
                        @if ($datos->imagen == '')
                          <img id="imagen_preview" class="img-responsive preview-image" />
                          <span id="imagen_span">Añadir imagen (1800 x 920 px)</span>
                        @else
                          <img id="imagen_preview" class="img-responsive preview-image" src="{{ asset($datos->imagen) }}" />
                          <span id="imagen_span"></span>
                        @endif
                      </div>                                        
                      <!-- fin imagen -->

                      <hr>

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Titulo 1 - Secci&oacute;n 1
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="titulo1" name="titulo1" value="{{ $datos->titulo1 }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Texto 1 - Secci&oacute;n 1
                      </span>
                      <div class="input-group ckeditor-texto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <textarea id="texto1" name="texto1" class="form-control">{{ $datos->texto1 }}</textarea>
                      </div>
                      <!-- end texto multilinea -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Titulo 2 - Secci&oacute;n 1
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="titulo2" name="titulo2" value="{{ $datos->titulo2 }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Texto 2 - Secci&oacute;n 1
                      </span>
                      <div class="input-group ckeditor-texto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <textarea id="texto2" name="texto2" class="form-control">{{ $datos->texto2 }}</textarea>
                      </div>
                      <!-- end texto multilinea -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Titulo 3 - Secci&oacute;n 1
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="titulo2b" name="titulo2b" value="{{ $datos->titulo2b }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Texto 3 - Secci&oacute;n 1
                      </span>
                      <div class="input-group ckeditor-texto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <textarea id="texto2b" name="texto2b" class="form-control">{{ $datos->texto2b }}</textarea>
                      </div>
                      <!-- end texto multilinea -->

                      <hr>

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Titulo - Secci&oacute;n 2
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="titulo3" name="titulo3" value="{{ $datos->titulo3 }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Texto - Secci&oacute;n 2
                      </span>
                      <div class="input-group ckeditor-texto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <textarea id="texto3" name="texto3" class="form-control">{{ $datos->texto3 }}</textarea>
                      </div>
                      <!-- end texto multilinea -->

                      <hr>

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Titulo - Secci&oacute;n 3
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="titulo4" name="titulo4" value="{{ $datos->titulo4 }}">
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Texto - Secci&oacute;n 3
                      </span>
                      <div class="input-group ckeditor-texto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <textarea id="texto4" name="texto4" class="form-control">{{ $datos->texto4 }}</textarea>
                      </div>
                      <!-- end texto multilinea -->

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

      autosize($('textarea'));
      
      CKEDITOR.config.stylesSet = [
        { name: 'Subtitulo', element: 'h4' },
        { name: 'Parrafo', element: 'p' },
        { name: 'Resaltar', element: 'span' }
      ];

      //CKEDITOR.config.colorButton_colors = 'C6342D,000000';
      CKEDITOR.config.extraPlugins = 'autogrow';
      CKEDITOR.config.autoGrow_minHeight = 200;

      CKEDITOR.addCss('.cke_editable h4{font-size: 18px;} .cke_editable p{font-size: 14px;} .cke_editable ul li{font-size: 14px;} .cke_editable span{text-decoration: underline;font-size: 16px;}');

      /*CKEDITOR.replace('nosotros',
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
      );*/

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