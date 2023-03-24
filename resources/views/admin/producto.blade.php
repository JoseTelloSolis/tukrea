@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <span class="help-block">
              <a href="{{ url()->previous() }}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver al listado de Productos</a>
            </span>

            <br><br>

            <form id="formulario" class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.producto.editar', $datos->id) }}" enctype="multipart/form-data">

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <!-- boton -->
              <div class="div-boton">
                <button type="submit" class="btn btn-success" id="guardar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Guardar Datos</button>

                <span id="mensaje-upload"></span>
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
                  <div class="panel-title">Editar Producto</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-8 pb-5 mb-5">

                      <div class="mb-3">    
                        @if ($datos->activo == 1)                                
                          <input id="js-switch" type="checkbox" name="activo" class="js-switch" checked />&nbsp;&nbsp;<label for="js-switch" id="checkbox-text" class="checkbox-text">Activo</label>
                        @else
                          <input id="js-switch" type="checkbox" name="activo" class="js-switch" />&nbsp;&nbsp;<label for="js-switch" id="checkbox-text" class="checkbox-text">Desactivado</label>
                        @endif
                      </div>

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Categoria
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <select name="id_categoria" class="form-control">
                          @foreach ($categorias as $categoria)    
                            <option value="{{ $categoria->id }}" {{ $datos->id_categoria == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Niveles
                      </span>
                      <div class="input-group">
                        <input type="hidden" id="niveles-actual" value="{{ $datos->niveles }}">                        
                        <select id="niveles" name="niveles[]" class="form-control" multiple>
                          @foreach ($niveles as $nivel)    
                            <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Grado <span>- solo para textos escolares</span>
                      </span>
                      <div class="input-group">                       
                        <select id="id_grado" name="id_grado" class="form-control">
                          <option value="0">No especificar</option>

                          @foreach ($grados as $grado)                            
                            <option value="{{ $grado->id }}" {{ $datos->id_grado == $grado->id ? 'selected' : '' }}>{{ $grado->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Nombre
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $datos->nombre }}" readonly>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Url
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        @if ($datos->url == '')
                          <input type="text" class="form-control" id="url" name="url" required>
                        @else
                          <input type="text" class="form-control" id="url" name="url" value="{{ $datos->url }}" required>
                        @endif
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Precio S/.
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="precio" name="precio" value="{{ $datos->precio }}" readonly>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- texto linea simple -->
                      <span class="help-block">
                        Stock
                      </span>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input type="text" class="form-control" id="stock" name="stock" value="{{ $datos->stock }}" readonly>
                      </div>
                      <!-- fin texto linea simple -->

                      <!-- imagen -->
                      <span class="help-block">
                        Imagen <span>- 900 x 600 px</span>
                      </span>
                      <input type="file" id="imagen" class="input-imagen" name="imagen" />
                      <div class="div-imagen" style="min-height:180px; max-width: 350px;" data-toggle="tooltip" data-placement="top" title="Clic en la imagen para reemplazarla">
                        @if ($datos->imagen == '')
                          <img id="imagen_preview" class="img-responsive preview-image" />
                          <span id="imagen_span">Añadir la imagen (900 x 600 px)</span>
                        @else
                          <img id="imagen_preview" class="img-responsive preview-image" src="{{ asset($datos->imagen) }}" />
                          <span id="imagen_span"></span>
                        @endif
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
                        <textarea class="form-control" id="resumen" name="resumen">{{ $datos->resumen }}</textarea>
                      </div>
                      <!-- fin texto multilinea -->   

                      <hr>

                      <div class="mb-3">    
                        @if ($datos->activar_colores == 1)                                
                          <input id="activar_colores" type="checkbox" name="activar_colores" class="js-switch" checked />&nbsp;&nbsp;<label for="activar_colores" class="checkbox-text">Activar Colores</label>
                        @else
                          <input id="activar_colores" type="checkbox" name="activar_colores" class="js-switch" />&nbsp;&nbsp;<label for="activar_colores" class="checkbox-text">Activar Colores</label>
                        @endif
                      </div>

                      @if ($datos->activar_colores == 1)
                      <div id="div-colores" class="jumbotron">
                      @else
                      <div id="div-colores" class="jumbotron" style="display:none;">
                      @endif

                        <button id="add-color" class="add-producto btn btn-primary mb-4" type="button"><i class="fa fa-plus"></i> Añadir Color</button>

                        <textarea id="lista-colores" name="lista_colores" style="display:none;"></textarea>

                        @forelse ($colores as $color)                     
                          <div id="div-color" class="row div-color mb-3">
                            <div class="col-sm-6">
                              <input type="text" class="form-control color" placeholder="Nombre Color" value="{{ $color->color }}">
                            </div>
                            <div class="col-sm-5">
                              <input type="text" class="form-control hexa jscolor" value="{{ $color->hexa }}">
                            </div>
                            <div class="col-sm-1">
                              <a href="javascript:void(0)" class="remove-color"><i class="fa fa-close"></i></a>
                            </div>
                          </div>                
                        @empty
                          <div id="div-color" class="row div-color mb-3">
                            <div class="col-sm-6">
                              <input type="text" class="form-control color" placeholder="Nombre Color">
                            </div>
                            <div class="col-sm-5">
                              <input type="text" class="form-control hexa jscolor">
                            </div>
                            <div class="col-sm-1">
                              <a href="javascript:void(0)" class="remove-color"><i class="fa fa-close"></i></a>
                            </div>
                          </div>
                        @endforelse 

                      </div>

                      <hr>

                      <div class="mb-3">    
                        @if ($datos->activar_tallas == 1)                                
                          <input id="activar_tallas" type="checkbox" name="activar_tallas" class="js-switch" checked />&nbsp;&nbsp;<label for="activar_tallas" class="checkbox-text">Activar Tallas</label>
                        @else
                          <input id="activar_tallas" type="checkbox" name="activar_tallas" class="js-switch" />&nbsp;&nbsp;<label for="activar_tallas" class="checkbox-text">Activar Tallas</label>
                        @endif
                      </div>

                      @if ($datos->activar_tallas == 1)
                      <div id="div-tallas" class="jumbotron">
                      @else
                      <div id="div-tallas" class="jumbotron" style="display:none;">
                      @endif

                        <button id="add-talla" class="add-producto btn btn-primary mb-4" type="button"><i class="fa fa-plus"></i> Añadir talla</button>

                        <textarea id="lista-tallas" name="lista_tallas" style="display:none;"></textarea>

                        @forelse ($tallas as $talla)                     
                          <div id="div-talla" class="row div-talla mb-3">
                            <div class="col-sm-11">
                              <select class="form-control talla">
                                <option value="XXS" {{ $talla->talla == 'XXS' ? 'selected' : '' }}>XXS</option>
                                <option value="XS" {{ $talla->talla == 'XS' ? 'selected' : '' }}>XS</option>
                                <option value="S" {{ $talla->talla == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ $talla->talla == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ $talla->talla == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ $talla->talla == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="XXL" {{ $talla->talla == 'XXL' ? 'selected' : '' }}>XXL</option>
                              </select>
                            </div>
                            <div class="col-sm-1">
                              <a href="javascript:void(0)" class="remove-talla"><i class="fa fa-close"></i></a>
                            </div>
                          </div>                
                        @empty
                          <div id="div-talla" class="row div-talla mb-3">
                            <div class="col-sm-11">
                              <select class="form-control talla">
                                <option value="XXS">XXS</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                              </select>
                            </div>
                            <div class="col-sm-1">
                              <a href="javascript:void(0)" class="remove-talla"><i class="fa fa-close"></i></a>
                            </div>
                          </div>
                        @endforelse 

                      </div>

                      <hr>

                      <div class="mb-3">    
                        @if ($datos->activar_agrupar == 1)                                
                          <input id="activar_agrupar" type="checkbox" name="activar_agrupar" class="js-switch" checked />&nbsp;&nbsp;<label for="activar_agrupar" class="checkbox-text">Añadir variantes</label>
                        @else
                          <input id="activar_agrupar" type="checkbox" name="activar_agrupar" class="js-switch" />&nbsp;&nbsp;<label for="activar_agrupar" class="checkbox-text">Añadir variantes</label>
                        @endif
                      </div> 

                      @if ($datos->activar_agrupar == 1)
                      <div id="div-productos" class="jumbotron">
                      @else
                      <div id="div-productos" class="jumbotron" style="display:none;">
                      @endif

                        <div id="div-producto" class="row div-producto mb-3">
                          <div class="col-sm-12">

                            <!-- select -->
                            <span class="help-block">
                              Elegir uno o varios productos del mismo grupo
                            </span>
                            <div class="input-group mt-3">   
                              <input type="hidden" id="productos-actuales" value="{{ $datos->ids_productos }}">                                        
                              <select id="ids-productos" name="ids_productos[]" class="form-control" multiple>
                                @foreach ($listaProductos as $item)
                                  <option value="{{ $item->id }}">{{ $item->codigo }} - {{ $item->nombre }}</option>
                                @endforeach
                              </select>
                            </div>
                            <!-- fin select --> 

                          </div>
                        </div> 

                      </div>

                      <!--
                      <span class="help-block">
                        Descripcion
                      </span>
                      <div class="input-group">
                        <textarea class="form-control" id="descripcion" name="descripcion">{{ $datos->descripcion }}</textarea>
                      </div>

                      <span class="help-block">
                        Informacion Adicional
                      </span>
                      <div class="input-group">
                        <textarea class="form-control" id="adicional" name="adicional">{{ $datos->adicional }}</textarea>
                      </div>
                      -->

                    </div>

                    <div class="col-md-4">

                      <h5 class="mb-3">Otras imagenes</h5>
                      
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="input-imagen" name="otra-imagen" aria-describedby="boton-subir-imagen">
                          <label class="custom-file-label" for="input-imagen"></label>
                        </div>
                        <div class="input-group-append">
                          <button type="button" class="btn btn-primary" id="boton-subir-imagen"><i class="fa fa-upload"></i> Subir</button>
                        </div>
                      </div>

                      <table id="table-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Imagen</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                          @forelse($imagenes as $dato)
                            <tr data-id="{{ $dato->id }}">
                              <td><img src="{{ asset($dato->imagen) }}" style="width: 100%; max-width: 120px;"></td>
                              <td class="text-center"><a href="{{ route('admin.producto.imagen.eliminar', $dato->id) }}" class="eliminar boton-eliminar" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a></td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="2">No hay imagenes para mostrar...</td>
                            </tr>
                          @endforelse
                        </tbody>
                        
                      </table>

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

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <script src="{{ asset('assets_admin/jscolor/jscolor.js') }}"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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

      $('#niveles').select2();
      $('#ids-productos').select2();

      var niveles = $('#niveles-actual').val();
      if(niveles != ''){
        var arr = niveles.split(',');

        $("#niveles").val(arr).trigger('change');
      }

      var idsProductos = $('#productos-actuales').val();

      if(idsProductos != '') {

        var arrayProductos = idsProductos.split(',');

        $('#ids-productos').val(arrayProductos).trigger('change');
      }

      $('#formulario').submit(function(e) {

        e.preventDefault();

        //colores
        objColores = [];

        $('.div-color').each(function(){

          var color = $(this).find('.color').val();
          var hexa = $(this).find('.hexa').val();

          item = {}
          item ['color'] = color;
          item ['hexa'] = hexa;

          objColores.push(item);
        });

        var jsonColores = JSON.stringify(objColores);

        $('#lista-colores').val(jsonColores);

        //tallas
        objTallas = [];

        $('.div-talla').each(function(){

          var talla = $(this).find('.talla').val();

          item = {}
          item ['talla'] = talla;

          objTallas.push(item);
        });

        var jsonTallas = JSON.stringify(objTallas);

        $('#lista-tallas').val(jsonTallas);

        $(this).unbind('submit').submit();
      });

      $('#add-color').click(function(){
        var div = $('#div-color').clone();

        div.css('display', 'none');
        $('#div-colores').append(div); 

        jscolor.installByClassName('jscolor');

        div.show(600);
      });

      $('#div-colores').on('click', '.remove-color', function(e){
        e.preventDefault();

        var conteo = $('.div-color').length;

        if(conteo > 1) {
          var padre = $(this).parent().parent();

          padre.addClass('removed-item').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            this.remove();
          });
        }
        
      });

      $('#add-talla').click(function(){
        var div = $('#div-talla').clone();

        div.css('display', 'none');
        $('#div-tallas').append(div); 

        div.show(600);
      });

      $('#div-tallas').on('click', '.remove-talla', function(e){
        e.preventDefault();

        var conteo = $('.div-talla').length;

        if(conteo > 1) {
          var padre = $(this).parent().parent();

          padre.addClass('removed-item').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
            this.remove();
          });
        }
        
      });

      $('.table').on('click', '.eliminar', function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        var confirmacion = confirm("Esta por eliminar una imagen. ¿Aún desea hacerlo?");
        
        if(confirmacion == true) {
          window.location.href = url;
        }
      });

      $('#boton-subir-imagen').click(function(){

        var formData = new FormData();
        var files = $('#input-imagen')[0].files[0];
        formData.append('file', files);

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: "{{ route('admin.producto.imagen', $datos->id) }}",
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){
              console.log(datos);
              if(datos == 'ok'){
                window.location.reload();
              }
              else {
                $("#mensaje-upload").css('color', 'red');
                $('#mensaje-upload').html('Error al subir la imagen');
              }
            },      
            error: function(xhr){
              console.log('Ocurrio un error.');
            },
            xhr: function(){
              var xhr = $.ajaxSettings.xhr();
              xhr.upload.onprogress = function(evt){ 
                $("#mensaje-upload").css('color', 'green');
                $('#mensaje-upload').html('Procesando: ' + parseInt(evt.loaded/evt.total*100) + '%');
              };
              xhr.upload.onload = function(){ console.log('Completado!') } ;
              return xhr ;
            }  
        });
      });


      $('#input-imagen').on('change',function(){
        //get the file name
        var fileName = $(this).val().split("\\").pop();
        //replace the "Choose a file" label
        $(this).parent().find('.custom-file-label').html(fileName);
      });

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

      var changeCheckbox = document.querySelector('#js-switch');

      changeCheckbox.onchange = function() {

        if(changeCheckbox.checked == 0) {
          $('#checkbox-text').html('Desactivado');
        }
        else{
          $('#checkbox-text').html('Activo');
        }
      };

      var activarColores = document.querySelector('#activar_colores');

      activarColores.onchange = function() {

        if(activarColores.checked == 1) {
          $('#div-colores').show('slow');
        }
        else{
          $('#div-colores').hide('slow');
        }
      };

      var activarTallas = document.querySelector('#activar_tallas');

      activarTallas.onchange = function() {

        if(activarTallas.checked == 1) {
          $('#div-tallas').show('slow');
        }
        else{
          $('#div-tallas').hide('slow');
        }
      };

      var activarAgrupar = document.querySelector('#activar_agrupar');

      activarAgrupar.onchange = function() {

        if(activarAgrupar.checked == 1) {
          $('#div-productos').show('slow');
        }
        else{
          $('#div-productos').hide('slow');
        }
      };
      
      autosize($('textarea'));

      CKEDITOR.config.stylesSet = [
        { name: 'Subtitulo', element: 'h4' },
        { name: 'Parrafo', element: 'p' }
      ];

      //CKEDITOR.config.colorButton_colors = 'C6342D,000000';
      CKEDITOR.config.extraPlugins = 'autogrow';
      CKEDITOR.config.autoGrow_minHeight = 200;

      CKEDITOR.addCss('.cke_editable h4{font-size: 18px;} .cke_editable p{font-size: 14px;} .cke_editable ul li{font-size: 14px;}');

      /*CKEDITOR.replace('descripcion',
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
      ); */

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

      var fixHelper = function(e, ui) {
        ui.children().each(function() {
          $(this).width($(this).width());
        });
        return ui;
      };

      $("#table-responsive tbody").sortable({
        helper: fixHelper,
        update: function(event, ui) {
            
          var contador = 1;

          var listado = [];

          $('#table-responsive tbody tr').each(function(){
            var id = $(this).attr('data-id');
            
            item = {};
            item['orden'] = contador;
            item['id'] = id;
            listado.push(JSON.stringify(item));

            contador++;
          });

          console.log(listado);

          $.ajax({
            data:  {'listado[]': listado},
            url:   "{{ route('admin.producto.imagen.ordenar') }}",
            type:  'GET',
            beforeSend: function() {
              console.log("procesando");
            },
            success: function(datos) {
              console.log(datos);
              //completo
              if(datos == 'ok'){
                console.log("orden OK");
              }
              else{
                //los datos son incorrectos
                console.log("no se pudo ordenar");
              }
            },
            error: function(xhr) {
              console.log("error");
            }
          });
        }
      }).disableSelection(); 

    });
  </script>

@endsection