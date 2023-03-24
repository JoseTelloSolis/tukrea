@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.configuraciones.editar') }}" enctype="multipart/form-data">

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
                  <div class="panel-title">Configuraciones</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">

                      <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav1-tab" data-toggle="tab" href="#nav1" role="tab" aria-controls="nav1" aria-selected="true">Empresa</a>
                          <a class="nav-item nav-link" id="nav3-tab" data-toggle="tab" href="#nav3" role="tab" aria-controls="nav3" aria-selected="false">Redes Sociales</a>
                          <a class="nav-item nav-link" id="nav4-tab" data-toggle="tab" href="#nav4" role="tab" aria-controls="nav4" aria-selected="true">Correos</a>
                          <a class="nav-item nav-link" id="nav5-tab" data-toggle="tab" href="#nav5" role="tab" aria-controls="nav5" aria-selected="true">Productos Maximo</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        
                        <div class="tab-pane fade show active" id="nav1" role="tabpanel" aria-labelledby="nav1-tab">                        

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Email de contacto <span>- mostrado en la cabecera</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $datos->email }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Email <span>- CC</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="email_copia" name="email_copia" value="{{ $datos->email_copia }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Telefono atencion al cliente <span>- mostrado en la cabecera</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="telefono3" name="telefono3" value="{{ $datos->telefono3 }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <hr>

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Direccion <span>- local 1</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="direccion1" name="direccion1" value="{{ $datos->direccion1 }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Telefono <span>- local 1</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="telefono1" name="telefono1" value="{{ $datos->telefono1 }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Email local 1 <span>- mostrado en el pie de pagina</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="email1" name="email1" value="{{ $datos->email1 }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Direccion <span>- local 2</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="direccion2" name="direccion2" value="{{ $datos->direccion2 }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Telefono <span>- local 2</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="telefono2" name="telefono2" value="{{ $datos->telefono2 }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Email local 2 <span>- mostrado en el pie de pagina</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="email2" name="email2" value="{{ $datos->email2 }}">
                          </div>
                          <!-- fin texto linea simple -->

                        </div>
                        
                        <div class="tab-pane fade" id="nav3" role="tabpanel" aria-labelledby="nav3-tab">
                          
                          <!-- texto linea simple -->
                          <span class="help-block">
                            Facebook <span>- para ocultar el icono, dejar en blanco</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $datos->facebook }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Twitter <span>- para ocultar el icono, dejar en blanco</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $datos->twitter }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Instagram <span>- para ocultar el icono, dejar en blanco</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $datos->instagram }}">
                          </div>
                          <!-- fin texto linea simple -->

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Youtube <span>- para ocultar el icono, dejar en blanco</span>
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $datos->youtube }}">
                          </div>
                          <!-- fin texto linea simple -->

                        </div>

                        <div class="tab-pane fade" id="nav4" role="tabpanel" aria-labelledby="nav4-tab">

                          <!-- texto multilinea -->
                          <span class="help-block">
                            Correo Registro <span>- recibido por el usuario al registrarse</span>
                          </span>
                          <div class="input-group">                                         
                            <textarea class="form-control" id="email_registro" name="email_registro">{{ $datos->email_registro }}</textarea>
                          </div>
                          <!-- fin texto multilinea -->  

                          <!-- texto multilinea -->
                          <span class="help-block">
                            Correo Pago con tarjeta <span>- recibido por el usuario al realizar una compra con tarjeta</span>
                          </span>
                          <div class="input-group">                                         
                            <textarea class="form-control" id="email_compra" name="email_compra">{{ $datos->email_compra }}</textarea>
                          </div>
                          <!-- fin texto multilinea -->

                          <!-- texto multilinea -->
                          <span class="help-block">
                            Correo Pago deposito <span>- recibido por el usuario al realizar una compra con deposito bancario</span>
                          </span>
                          <div class="input-group">                                         
                            <textarea class="form-control" id="email_compra_deposito" name="email_compra_deposito">{{ $datos->email_compra_deposito }}</textarea>
                          </div>
                          <!-- fin texto multilinea -->   

                        </div>

                        <div class="tab-pane fade" id="nav5" role="tabpanel" aria-labelledby="nav5-tab">                        

                          <!-- texto linea simple -->
                          <span class="help-block">
                            Cantidad maxima por producto
                          </span>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <input type="text" class="form-control" id="productos_maximo" name="productos_maximo" value="{{ $datos->productos_maximo }}">
                          </div>
                          <!-- fin texto linea simple -->

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
      CKEDITOR.config.stylesSet = [
        { name: 'Subtitulo', element: 'h4' },
        { name: 'Parrafo', element: 'p' },
        { name: 'Resaltar', element: 'span' }
      ];

      //CKEDITOR.config.colorButton_colors = 'C6342D,000000';
      CKEDITOR.config.extraPlugins = 'autogrow';
      CKEDITOR.config.autoGrow_minHeight = 200;

      CKEDITOR.addCss('.cke_editable h4{font-size: 18px;} .cke_editable p{font-size: 14px;} .cke_editable ul li{font-size: 14px;} .cke_editable span{text-decoration: underline;font-size: 16px;}');


      CKEDITOR.replace('email_registro',
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

      CKEDITOR.replace('email_compra',
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

      CKEDITOR.replace('email_compra_deposito',
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

      /*CKEDITOR.replace('email_comprado',
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

      CKEDITOR.replace('email_no_comprado',
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