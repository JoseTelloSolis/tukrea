@extends('web.plantilla')

@section('submenu-boton')
  <li>
    <a href="javascript:void(0)" id="ver-submenu"><i class="fas fa-bars"></i></a>
  </li>
@endsection

@section('submenu')
  
  <div id="submenu-modal" class="modal">

    <div class="modal-header">
      <a href="#" rel="modal:close"><i class="fas fa-times"></i></a>
      <h2>{{ $datosCategoria->nombre }}</h2>
    </div>

    <div class="modal-body">

      <ul id="menu">
        @foreach($datosSubfamilias as $subfamilia)
          <li >
            <div>{{ $subfamilia->nombre }}</div>
            @php
              $datosGrupos = App\Grupos::select()->where('id_subfamilia', $subfamilia->id)->where('activo', 1)->get(); 
            @endphp
            <ul>
              @foreach($datosGrupos as $grupo)
                <li>
                  <div><a href="{{ route('grupos', [ 'categoria' => $datosCategoria->url, 'url' => $grupo->url ]) }}">{{ $grupo->nombre}}</a></div>                  
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>

    </div>
    
  </div>
@endsection

@section('contenido')
  
  <div class="container">
    <div class="flex-slider-border">
      <div class="flexslider">
        <img src="{{ asset($datosCategoria->banner) }}" title="" alt="">
        <div class="titulo3">
          {!! $datosCategoria->descripcion !!}
        </div>
      </div>
      
      <nav>
        <div>
          <!-- SUB MENU mobile -->
          <select class="select-menu2">
            <option value="#">
              Navigate to...
            </option>
            <option value="javascript:void(0)">
              &nbsp;Escritura
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/lapiceros.html">
              ––&nbsp;Lapiceros
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/correctores.html">
              ––&nbsp;Correctores
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/portaminas.html">
              ––&nbsp;Portaminas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/resaltadores.html">
              ––&nbsp;Resaltadores
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/borradores.html">
              ––&nbsp;Borradores y Motas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/lapices.html">
              ––&nbsp;Lápices
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/tajadores.html">
              ––&nbsp;Tajadores
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/minas.html">
              ––&nbsp;Minas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/reglas.html">
              ––&nbsp;Reglas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/escuadras.html">
              ––&nbsp;Escuadras
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/cuadernos.html">
              ––&nbsp;Cuadernos
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/escritura/tizas.html">
              ––&nbsp;Tizas
            </option>
            <option value="javascript:void(0)">
              &nbsp;Dibujo y pintura
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/dibujo-y-pintura/colores.html">
              ––&nbsp;Colores
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/dibujo-y-pintura/crayones.html">
              ––&nbsp;Crayones
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/dibujo-y-pintura/temperas.html">
              ––&nbsp;Temperas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/dibujo-y-pintura/plumones.html">
              ––&nbsp;Plumones
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/dibujo-y-pintura/pinturas.html">
              ––&nbsp;Pinturas
            </option>
            <option value="javascript:void(0)">
              &nbsp;Pegamentos y limpiatipos
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/pegamentos/pegamentos.html">
              ––&nbsp;Pegamentos
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/pegamentos/pegamentos-en-barra.html">
              ––&nbsp;Pegamentos en barra
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/pegamentos/gomas-l%C3%ADquidas.html">
              ––&nbsp;Gomas Líquidas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/pegamentos/gomas-escarchadas.html">
              ––&nbsp;Gomas escarchadas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/pegamentos/silicona.html">
              ––&nbsp;Silicona
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/pegamentos/limpiatipos.html">
              ––&nbsp;Limpiatipos
            </option>
            <option value="javascript:void(0)">
              &nbsp;Plastilinas y tijeras
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/plastilinas-y-tijeras/plastilinas.html">
              ––&nbsp;Plastilinas
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/plastilinas-y-tijeras/cer%C3%A1micas-en-fr%C3%ADo.html">
              ––&nbsp;Cerámicas en frío
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/plastilinas-y-tijeras/tijeras.html">
              ––&nbsp;Tijeras
            </option>
            <option value="javascript:void(0)">
              &nbsp;Folders y forros
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/folders-y-forros/forros-a4-y-oficio.html">
              ––&nbsp;Forros A4 y oficio
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/folders-y-forros/folders-a4-y-oficio.html">
              ––&nbsp;Folders A4 y oficio
            </option>
            <option value="javascript:void(0)">
              &nbsp;Cubos
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/cubos/duplicate-of-forros-a4-y-oficio.html">
              ––&nbsp;Duplicate of Forros A4 y oficio
            </option>
            <option value="http://www.utilesayllu.com/modx/categorias/escolar/cubos/duplicate-of-folders-a4-y-oficio.html">
              ––&nbsp;Cubo 3x3
            </option>
          </select>
        </div>
      </nav>

    </div>
  </div>
  <!-- close .container -->
  <div class="clearfix">
  </div>
  <!-- INICIO DEL CUERPO DE LOS PRODUCTOS -->
  <div class="container">
    <!-- BLOQUE IZQUIERDO -->
    <div id="container-sidebar">
      <div id="container">
        <div id="content" role="main">
          
          <div id="lista_productos" class="products product-list"></div>

          <div class="clear"></div>
          
          <div class='div-pagination'>
            <ul class="pagination">
              
            </ul>
          </div>
        </div>
      </div>
    </div>
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
    var datos = @json($datosProductos);

    var $page = jQuery('#lista_productos');
    var $currentPage =  1;
    var itemsPerPage = 15;
    var $numberOfPages;
    var $productsList = jQuery('#lista_productos .product-container');
    var $productsCount = $productsList.length;
    var $productDetails = jQuery('#lista_productos .product-container .product-column');

    function mostrarDatos(arrayDatos) {

      var output = '';

      if(arrayDatos.length > 0) {
        for(dato of arrayDatos) {

          var url = "{{ route('producto', ':url') }}".replace(':url', dato.url);
          var imagen = "{{ asset(':imagen') }}".replace(':imagen', dato.imagen);

          output += `
            <div class="product-container promo portfolio-items-page" style="margin-top: 18px">
              <div class="product-column">
                <div class="item-container shop-item-zoom">
                  <div class="item-container-image item-container-spacer">
                    <div class="sombra radius marco"></div>
                    <a href="${url}" class="zoom-icon zoom-icon-article"></a>
                    <img src="${imagen}" class="radius attachment-product wp-post-image"
                    alt="" title="" />
                  </div>
                  <div class="item-container-content">
                    <div class="aligncenter sub2">
                      <h2 class="product-nombre">${dato.nombre}</h2>
                      <h3>S/. <span class="product-precio">${dato.precio}</span></h3>
                      <p>${dato.resumen}</p>
                    </div>
                    <div class="aligncenter">
                      <div class="outer-center">
                        <div class="product inner-center">
                          <a href="${url}" class="btn_promo">
                            <span class="lf"></span>
                            <span>Agregar a mi mochila</span>
                            <span class="rg"></span>
                          </a>
                        </div>
                      </div>
                      <div class="clearfix">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          `;

          output += '<div class="clearfix"></div>';
        }
      }
      else {
        output = `
          <div class="titulo-buscar">
            <h4>No se encontraron productos para su busqueda</h4>
          </div> 
        `;
      }

      jQuery('#lista_productos').empty();
      jQuery('#lista_productos').html(output);  

      $productsList = jQuery('#lista_productos .product-container');
      $productsCount = $productsList.length;
      $productDetails = jQuery('#lista_productos .product-container .product-column');

      paginate($currentPage, $productsList);
      clickPage();    
    }

    function ordenarAZ(a, b){
      var aName = a.nombre.toLowerCase();
      var bName = b.nombre.toLowerCase(); 
      return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
    }

    function ordenarZA(a, b){
      var aName = a.nombre.toLowerCase();
      var bName = b.nombre.toLowerCase(); 
      return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
    }

    function ordenarMenorMayor(a, b){
      var aName = parseFloat(a.precio);
      var bName = parseFloat(b.precio); 
      return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
    }

    function ordenarMayorMenor(a, b){
      var aName = parseFloat(a.precio);
      var bName = parseFloat(b.precio); 
      return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
    }

    jQuery(document).ready(function($) {

      mostrarDatos(datos);

      $("#slider-range").slider({
        range: true,
        min: 0,
        max: 999,
        values: [ 0, 999 ],
        slide: function(event, ui) {
          $('#rango-minimo').val(ui.values[0]);
          $('#rango-maximo').val(ui.values[1]);

          $('#texto-precios').html(ui.values[0] + ' - ' + ui.values[1]);
        }
      });

      $('#aplicar-filtros').click(function(){
        filterProducts($('#rango-minimo').val(), $('#rango-maximo').val());
      });

      $('#ordenar-a-z').click(function(){
        datos.sort(ordenarAZ);
        mostrarDatos(datos);
        filterProducts($('#rango-minimo').val(), $('#rango-maximo').val());
      });

      $('#ordenar-z-a').click(function(){
        datos.sort(ordenarZA);
        mostrarDatos(datos);
        filterProducts($('#rango-minimo').val(), $('#rango-maximo').val());
      });

      $('#ordenar-precio-menor').click(function(){
        datos.sort(ordenarMenorMayor);
        mostrarDatos(datos);
        filterProducts($('#rango-minimo').val(), $('#rango-maximo').val());
      });

      $('#ordenar-precio-mayor').click(function(){
        datos.sort(ordenarMayorMenor);
        mostrarDatos(datos);
        filterProducts($('#rango-minimo').val(), $('#rango-maximo').val());
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

    });
  </script>     

@endsection