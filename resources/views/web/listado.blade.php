@extends('web.plantilla')


@section('contenido')
  
  <div class="container">
    <div class="flex-slider-border">
      <div class="flexslider">
      </div>
      <!-- SUB MENU -->
    </div>
  </div>
  <!-- close .container -->
  <div class="clearfix">
  </div>
  <!-- INICIO DEL CUERPO DE LOS PRODUCTOS -->
  <div class="container">
    <!-- BLOQUE IZQUIERDO --> 
    <div>
      <div class="lema1 left">
        <h2>Ahora elige tu colegio!</h2>
        <p><span>Seleccione el centro educativo en la que se encuentra.</span></p>
      </div>
      <div class="boy1 left" style="background:url({{ asset('images/jose1.jpg') }}) center no-repeat"></div>
      <div class="clear"></div>
    </div>     
    <div id="container-sidebar">
      <div>
        <span class="mago">
          <select name="colegio" id="colegio" class="selectx" style="width:203px">
            <option value="0">Seleccione el colegio</option>
            @forelse ($colegios as $dato)
              <option value="{{ $dato->id_colegio }}">{{ $dato->nombre_colegio }}</option>
            @empty
              <option value="0">No hay colegios ingresados</option>
            @endforelse
          </select>
        </span>
        <span class="mago1">
          <select name="nivel" id="nivel" class="selectx" style="width:203px;"></select>
        </span>
        <span class="mago2">
          <select name="grado" id="grado" class="selectx" style="width:203px;"></select>
        </span>
        <button name="boton" type="button" class="update_cart" id="mostrar" disabled>Mostrar</button>
      </div>

      <form id="listado_utiles">
        <table id="utiles" class="shop_table">
          <thead>
            <tr>
              <th class="product-name">PRODUCTO</th>
              <th class="product-name">CODIGO</th>
              <th class="product-price">PRECIO</th>
              <th class="product-quantity2">CANTIDAD</th>
              <th class="product-quantity">DISPONIBLE</th>
            </tr>
          </thead>
          <tbody id="cuerpo-lista">
              
          </tbody>
        </table>
        <div class="lemx left"> 
          <div class="boy2 left" style="background:url({{ asset('images/jose2.jpg') }}) center no-repeat"></div>
          <div class="lema2 right">
            <h2>Con solo un click pide tu lista.</h2>
            <p>Elige tus productos con facilidad.</p>
          </div>
          <div class="clear"></div>
        </div>
        
        <textarea id="productos_lista" style="display:none;"></textarea>

        <div class="right">
          <button name="boton" type="button" class="contact_btn right" id="pedir">quiero pedir mi lista!</button>
        </div>
        <div class="clear"></div>
      </form>
    </div><!-- close #container-sidebar -->
    <!-- BLOQUE IZQUIERDO -->
    <!-- close #container-sidebar -->

    <!-- BLOQUE DERECHO -->
    @include('web.sidebar')
    <!-- BLOQUE DERECHO -->
  </div>
  <!-- close .container -->
  <div class="clearfix"></div>

@endsection    

@section('script')        
            
  <script type="text/javascript">

    var asset = '{{ asset('') }}';

    function reiniciarNivel($) {
      var opciones = '<option value="0">Seleccione el Nivel</option>';

      $('#nivel').html(opciones);
      $('#nivel').select2(); 
    }

    function reiniciarGrado($) {
      var opciones = '<option value="0">Seleccione el Grado</option>';

      $('#grado').html(opciones);
      $('#grado').select2(); 
    }

    jQuery(document).ready(function($) {

      $('.selectx').select2();

      $('#colegio').change(function(){

        reiniciarGrado($);
        reiniciarNivel($);

        //deshabilitar boton mostrar
        $('#mostrar').attr('disabled', 'disabled');

        var id_colegio = $(this).val();

        var opciones = '<option value="0">Seleccione el Nivel</option>';

        var parametros = { 
          'id_colegio' : id_colegio
        };

        $.ajax({
          url: '{{ route("get.niveles") }}',
          type: 'GET',          
          data: parametros,
          success: function(datos) {
            var niveles = JSON.parse(datos);

            $.each(niveles, function(key, value) {
              opciones += '<option value="' + value.id_nivel + '">' + value.nombre_nivel + '</option>';
            });

            $('#nivel').html(opciones);
            $('#nivel').select2(); 
          }    
        });
     
      });

      $('#nivel').change(function(){

        reiniciarGrado($);

        //deshabilitar boton mostrar
        $('#mostrar').attr('disabled', 'disabled');

        var id_colegio = $('#colegio').val();
        var id_nivel = $(this).val();

        var opciones = '<option value="0">Seleccione el Grado</option>';

        var parametros = { 
          'id_colegio' : id_colegio,
          'id_nivel' : id_nivel
        };

        $.ajax({
          url: '{{ route("get.grados") }}',
          type: 'GET',          
          data: parametros,
          success: function(datos) {
            var grados = JSON.parse(datos);

            $.each(grados, function(key, value) {
              opciones += '<option value="' + value.id_grado + '">' + value.nombre_grado + '</option>';
            });

            $('#grado').html(opciones);
            $('#grado').select2(); 
          }    
        });
     
      });

      $('#grado').change(function(){

        //habilitar boton mostrar
        $('#mostrar').removeAttr('disabled');
      });

      $('#mostrar').click(function(){

        var id_colegio = $('#colegio').val();
        var id_nivel = $('#nivel').val();
        var id_grado = $('#grado').val();

        var parametros = { 
          'id_colegio' : id_colegio,
          'id_nivel' : id_nivel,
          'id_grado' : id_grado
        };

        $.ajax({
          url: '{{ route("get.listado") }}',
          type: 'GET',          
          data: parametros,
          success: function(datos) {

            console.log(datos);

            $('#productos_lista').val(datos);

            var productos = JSON.parse(datos);
            var lista = '';

            $.each(productos, function(key, value) {

              lista += '<tr class="cart_table_item">'+
                  '<td class="product-name">'+
                    '<div class="detp">'+
                      '<img width="90" height="56" src="' + asset + value.imagen + '" class="attachment-shop_thumbnail wp-post-image" alt="" title="">'+
                      '<p>' + value.nombre + '</p>'+
                    '</div>'+
                  '</td>'+
                  '<td class="product-name">' + value.codigo + '</td>'+
                  '<td class="product-prices">S/. ' + (value.precio).toFixed(2) + '</td>'+
                  '<td class="product-quantity2">' + value.cantidad + '</td>';

              if(value.stock <= 0) {
                lista += '<td class="product-quantity" style="color:red">Agotado</td>';
              }
              else{
                if(value.cantidad > value.stock){
                  lista += '<td class="product-quantity" style="color:oragen">'+parseInt(value.stock)+' disponibles</td>';
                }
                else{
                  lista += '<td class="product-quantity" style="color:green">Disponible</td>';
                }
              }

              lista += '</tr>';
              
            });

            $('#cuerpo-lista').html(lista);
          }    
        });
     
      });

      $('#pedir').click(function(){

        var listado = $('#productos_lista').val();

        if(listado == ''){
          return;
        }

        var parametros = {
          'listado' : listado
        }

        $.ajax({
          url: '{{ route("add.listado") }}',
          type: 'GET',          
          data: parametros,
          success: function(datos) {
            if(datos == 'ok'){

              miniCart($);

              $("#carrito-modal").modal({
                fadeDuration: 100
              });
            }
          }    
          
        });
      });

      $("#submenu2 ul li").hover(function() {
        $("a.mostrar", this).addClass('active3');
        $(".oculto", this).fadeIn("fast");
      }, function() {
        $("a.mostrar", this).removeClass('active3');
        $(".oculto", this).fadeOut("fast");
      })

      $("#submenu2 .oculto").hover(function() {
        $(this).parent().find('a.mostrar').addClass('active3');
        $(this).parent().find('a.mostrar').css({
          'background': 'url(img/lno.png) center 38px no-repeat'
        });
      }, function() {
        $(this).parent().find('a.mostrar').css({
          'background': 'none'
        });
        $(this).parent().find('a.mostrar').removeClass('active3');
      });

      $('#tab1').click(function() {
        $('#information').fadeOut();
        $('#description').delay(500).fadeIn(); 
        $('#tab1').addClass('active'); 
        $('#tab2').removeClass('active'); 
      });
     
      $('#tab2').click(function() {
        $('#description').fadeOut();
        $('#information').delay(500).fadeIn(); 
        $('#tab2').addClass('active');
        $('#tab1').removeClass('active'); 
      });


    });
  </script>     

@endsection