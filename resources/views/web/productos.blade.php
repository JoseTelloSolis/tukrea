@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      height: auto;
      margin-bottom: 40px;
    }
    header::before {
      background-image: url('{{ asset($portada->imagen) }}');
    }
    .set {
      font-size: 14px;
    }
    .cod-precio {
      font-size: 16px !important;
    }
    .product-container.m3{
      margin-bottom: 30px;
    }
    .page {
      display: none;
    }
    .page-active {
      display: block;
    }
    .product-container.m3{
      /*height: 675px;*/
    }
    .product-container .title a {
      color: rgba(0,0,0,0.87);
    }
    .list-flex {
      display: flex;
      flex-wrap: wrap;
    }
    .list-flex .product-container {
      margin-left: 0 !important;
    }
  </style>

  <header>
    <div class="container">
      <h1></h1>
      <p></p>
    </div>
  </header>

  <div id='nav-bg'></div>

  <section class="section-tabs">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <ul class="tabs">
            <li class="tab col s3"><a href="#test1" class="active">INDIVIDUAL</a></li>
            <li class="tab col s3"><a href="#test2">POR NIVELES</a></li>
          </ul>
        </div>
        <div id="test1" class="col s12">
          <div class="tab-content border">

            <!-- buscador -->
            <div class="row">
              <div class="col s12 right-align">

                <div class="input-field container-filtros">
                  <select id="ordenar">
                    <option value="" disabled selected>Elegir</option>
                    <option value="az">A - Z</option>
                    <option value="za">Z - A</option>
                    <option value="precio-menor">Precio menor</option>
                    <option value="precio-mayor">Precio mayor</option>
                  </select>
                  <label>Ordenar por:</label>
                </div>

                <a href="#" class="list waves-effect waves-light list-button active"><i class="fas fa-th-list"></i></a>
                <a href="#" class="gallery waves-effect waves-light list-button"><i class="fas fa-th-large"></i></a>
                <div class="products buscar">
                  <div class="input-field ma-0">
                    <input id="texto-buscar" type="text" placeholder="Buscar">
                    <button type="button" id="buscar" class="btn-flat"><i class="material-icons">search</i></button>
                  </div>
                </div>                  
              </div>
            </div>
            <!-- end buscador -->

            <hr>

            <div id="product-list" class="row product-list">

              <div class="col s12 div-pagination">
                <ul class="pagination right">
                  
                </ul>
              </div>
                              
            </div>                          

          </div>
        </div>

        <div id="test2" class="col s12">
          <div class="tab-content border">

            <!-- buscador -->
            <div class="row">
              <div class="col s12 right-align">
                <a href="#" class="list waves-effect waves-light list-button active"><i class="fas fa-th-list"></i></a>
                <a href="#" class="gallery waves-effect waves-light list-button"><i class="fas fa-th-large"></i></a>
                                
              </div>
            </div>
            <!-- end buscador -->

            <hr>

            <div class="row product-list-nivel">
            
              @foreach ($niveles as $nivel)

                @php

                  $productosNiveles = App\Productos::select()
                  ->where('activo', 1)
                  ->where('imagen', '!=', '')
                  ->whereRaw('FIND_IN_SET('.$nivel->id.', niveles)')
                  ->get();

                @endphp

                @if(!$productosNiveles->isEmpty())
                  <div class="col s12">
                    <h3 class="kit-title"><span>{{ $nivel->nombre }}</span></h3>
                  </div>
                @endif

                @foreach ($productosNiveles as $item)
                  <!-- producto -->
                  <div class="product-container">
                    <div class="col m4 product-image">
                      <a href="{{ route('producto', $item->url) }}">
                        <img src="{{ asset($item->imagen) }}" class="responsive-img">
                      </a>
                      <div class="center title hide">
                        <a href="{{ route('producto', $item->url) }}">
                          <h3>{{ $item->nombre }}</h3>
                        </a>
                      </div>
                      <div class="button center button-image">
                        <a href="{{ route('producto', $item->url) }}" class="waves-effect waves-light btn">Ver m&aacute;s</a>
                      </div>                  
                    </div>
                    <div class="col s12 m5 text product-text">
                      <h3>{{ $item->nombre }}</h3>
                      <p>{!! nl2br($item->resumen) !!}</p>
                    </div>
                    <div class="col m3 price center product-price s12 m12">
                      <div class="product-price-money col s12">
                        <p>S/ {{ $item->precio }}</p>
                      </div>  

                      <form class="formulario form-prod col s12"> 

                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idx" value="{{ $item->id }}">   

                        <input type="hidden" id="input-color" name="color">

                        @if ($item->activar_colores == true)
                          <input type="hidden" id="activar-colores" name="activar_colores" value="1">
                        @else
                          <input type="hidden" id="activar-colores" name="activar_colores" value="0">
                        @endif

                        @if ($item->activar_tallas == true)
                          <input type="hidden" id="activar-tallas" name="activar_tallas" value="1">
                        @else
                          <input type="hidden" id="activar-tallas" name="activar_tallas" value="0">
                        @endif         

                        @if ($item->stock > 0)  
                          <div class="product-price-value">
                            <div class="number-input">
                              <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                              <input class="quantity" name="quantity" value="1" type="number" min="1" max="{{ $configuraciones->productos_maximo }}" readonly>
                              <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                            </div>
                            <div class="button center">
                              <button type="submit" class="waves-effect waves-light btn">Agregar</button>
                            </div> 
                          </div>
                        @else
                          <h4 class="sin-stock">Sin stock</h4>
                        @endif   
                      </form>             
                      
                    </div>

                    @if(!$loop->last)
                      <div class="col s12">
                        <hr>
                      </div>
                    @endif                  
                  </div>                
                  <!-- end producto -->
                @endforeach 

              @endforeach

              <div class="col s12 div-pagination-nivel">
                <ul class="pagination-nivel right">
                  
                </ul>
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection

@section('script')

  <script type="text/javascript">

    var datos = @json($productos);

    var $page = jQuery('#product-list');
    var $currentPage =  1;
    var itemsPerPage = 8;
    var $numberOfPages;
    var $productsList = jQuery('#product-list .product-container');
    var $productsCount = $productsList.length;
    //var $productDetails = jQuery('#lista_productos .product-container .product-column');

    function nl2br(texto){
      return texto.replace(/(\r\n|\n\r|\r|\n)/g, "<br>");
    };

    function mostrarDatos(arrayDatos) {

      var output = '';

      if(arrayDatos.length > 0) {

        for(dato of arrayDatos) {

          var url = "{{ route('producto', ':url') }}".replace(':url', dato.url);
          var imagen = "{{ asset(':imagen') }}".replace(':imagen', dato.imagen);
          var csrf_token = "{{ csrf_token() }}";
          var maximo = "{{ $configuraciones->productos_maximo }}";

          output += `
            <div class="product-container">
              <div class="col m4 product-image">
                <a href="${url}">
                  <img src="${imagen}" class="responsive-img">
                </a>
                <div class="center title hide">
                  <a href="${url}">
                    <h3>${dato.nombre}</h3>
                  </a>
                </div>
                <div class="button center button-image">
                  <a href="${url}" class="waves-effect waves-light btn">Ver m&aacute;s</a>
                </div>                  
              </div>
              <div class="col s12 m5 text product-text">
                <h3>${dato.nombre}</h3>
                <p>${nl2br(dato.resumen)}</p>
              </div>
              <div class="col m3 price center product-price s12 m12">
                <div class="product-price-money col s12">
                  <p>S/ ${dato.precio}</p>
                </div>  

                <form class="formulario form-prod col s12"> 

                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="_token" value="${csrf_token}">
                  <input type="hidden" name="idx" value="${dato.id}">   

                  <input type="hidden" id="input-color" name="color">
          `;

          if(dato.activar_colores){
            output += `
              <input type="hidden" id="activar-colores" name="activar_colores" value="1">
            `;
          }
          else{
            output += `
              <input type="hidden" id="activar-colores" name="activar_colores" value="0">
            `;
          }

          if(dato.activar_tallas){
            output += `
              <input type="hidden" id="activar-tallas" name="activar_tallas" value="1">
            `;
          }
          else{
            output += `
              <input type="hidden" id="activar-tallas" name="activar_tallas" value="0">
            `;
          }

          if(dato.stock > 0){
            output += `
              <div class="product-price-value">
                <div class="number-input">
                  <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                  <input class="quantity" name="quantity" value="1" type="number" min="1" max="${maximo}" readonly>
                  <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                </div>
                <div class="button center">
                  <button type="submit" class="waves-effect waves-light btn">Agregar</button>
                </div> 
              </div>
            `;
          }
          else{
            output += `
              <h4 class="sin-stock">Sin stock</h4>
            `;
          }
          
          output += `
                </form>             
                
              </div>
              <div class="col s12">
                <hr>
              </div>
            </div>
          `;                             
        }
      }
      else {
        output = `
          <div class="titulo-buscar">
            <h4>No se encontraron productos para su busqueda</h4>
          </div> 
        `;
      }

      jQuery('#product-list').empty();
      jQuery('#product-list').html(output);  

      $productsList = jQuery('#product-list .product-container');
      $productsCount = $productsList.length;
      //$productDetails = jQuery('#product-list .product-container .product-column');

      paginate($currentPage, $productsList);
      clickPage();    
    }

    function buscar(data, search) {
      var obj = data;
      var resultados = [];

      obj.forEach(function(item) {
        var nombre = (item.nombre).toLowerCase();
        var buscar = search.toLowerCase();

        if(nombre.includes(buscar)) {
          resultados.push(item);
        }
      });

      return JSON.stringify(resultados); 
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

    $(document).ready(function(){

      mostrarDatos(datos);

      $('#ordenar').change(function(){

        var orden = $(this).val();

        if(orden == 'az') {
          datos.sort(ordenarAZ);
          mostrarDatos(datos);
        }
        else if(orden == 'za') {
          datos.sort(ordenarZA);
          mostrarDatos(datos);
        }
        else if(orden == 'precio-menor') {
          datos.sort(ordenarMenorMayor);
          mostrarDatos(datos);
        }
        else if(orden == 'precio-mayor') {
          datos.sort(ordenarMayorMenor);
          mostrarDatos(datos);
        }

        $('.gallery').trigger( "click" );
      });

      $('#buscar').click(function(){
        var texto = $('#texto-buscar').val();

        var resultados = buscar(datos, texto);

        mostrarDatos(JSON.parse(resultados));
        $('.gallery').trigger( "click" );
      });

      $('#texto-buscar').bind("enterKey",function(e){
        var texto = $('#texto-buscar').val();

        var resultados = buscar(datos, texto);

        mostrarDatos(JSON.parse(resultados));
        $('.gallery').trigger( "click" );
      });

      $('#texto-buscar').keyup(function(e){
        if(e.keyCode == 13){
          $(this).trigger("enterKey");
        }
      });

      $('#product-list').on('submit', '.formulario', function(e){

        e.preventDefault(); 

        var formData = new FormData($(this)[0]);  

        $.ajax({
          url: '{{ route("carrito.add") }}',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: formData,
          success: function(datos) {
            if(datos == 'ok'){
              carritoConteo();
              $('#modal-cart').modal('open');
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          },
          xhr: function(){
            // get the native XmlHttpRequest object
            var xhr = $.ajaxSettings.xhr() ;
            // set the onprogress event handler
            xhr.upload.onprogress = function(evt){ 
              //console.log('progress', evt.loaded/evt.total*100)
            };
            // set the onload event handler
            xhr.upload.onload = function(){ console.log('Completado!') } ;
            // return the customized object
            return xhr ;
          }     
        });
      });

      $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true,
        noWrap: true,
        shift: 10
      });

      $('.carousel-gallery .image-container').click(function() {
        var id = $(this).attr('data-rel');
        $('.carousel').carousel('set', id - 1);
      });

      $('.tabs').tabs();

      $('.list').click(function(e){
        e.preventDefault();

        $('.list').addClass('active');
        $('.gallery').removeClass('active');

        $('.product-list').removeClass('list-flex');

        $('.product-container').removeClass('col s12 m3');
        $('.product-container .product-image').removeClass('m12').addClass('m4');
        $('.product-container .product-text').removeClass('hide');
        $('.product-container .product-price').removeClass('s12 m12').addClass('s12 m3');
        
        $('.product-container .product-price-money').removeClass('col s5');  
        $('.product-container .form-prod').removeClass('col s12');  
        $('.product-container .product-image .button-image').removeClass('hide');
        $('.product-container .product-image .title').addClass('hide'); 

        $('.product-list hr').removeClass('hide');
        $('.product-list-nivel hr').removeClass('hide');  
      });

      $('.gallery').click(function(e){
        e.preventDefault();

        $('.list').removeClass('active');
        $('.gallery').addClass('active');

        $('.product-list').addClass('list-flex');

        $('.product-container').addClass('col s12 m3');
        $('.product-container .product-image').removeClass('m4').addClass('m12');
        $('.product-container .product-text').addClass('hide');
        $('.product-container .product-price').removeClass('s12 m3').addClass('s12 m12');

        $('.product-container .product-price-money').addClass('col s5');  
        $('.product-container .form-prod').addClass('col s12');  
        $('.product-container .product-image .button-image').addClass('hide');
        $('.product-container .product-image .title').removeClass('hide');   

        $('.product-list hr').addClass('hide'); 
        $('.product-list-nivel hr').addClass('hide');         
      });

      $('.gallery').trigger( "click" );

      (function($) {
        var pagifyNivel = {
          items: {},
          container: null,
          totalPages: 1,
          perPage: 3,
          currentPage: 0,
          createNavigation: function() {
            this.totalPages = Math.ceil(this.items.length / this.perPage);

            $('.pagination-nivel', this.container.parent()).remove();
            var pagination = $('<ul class="pagination-nivel right"></ul>').append('<li class="disabled"><a href="javascript:void(0)" class="nav prev" data-next="false"><i class="material-icons">chevron_left</i></a></li>');

            for (var i = 0; i < this.totalPages; i++) {
              var pageElClass = "page";
              var liElClass = '';
              if (!i) {
                liElClass = 'active';
                pageElClass = "page current";
              }
              var pageEl = '<li class="' + liElClass + '"><a href="javascript:void(0)" class="' + pageElClass + '" data-page="' + (
              i + 1) + '">' + (
              i + 1) + '</a></li>';
              pagination.append(pageEl);
            }
            pagination.append('<li><a href="javascript:void(0)" class="nav next" data-next="true"><i class="material-icons">chevron_right</i></a></li>');

            $('.div-pagination-nivel').html(pagination);

            var that = this;
            $("body").off("click", ".nav");
            this.navigator = $("body").on("click", ".nav", function() {
              var el = $(this);
              that.navigate(el.data("next"));
            });

            $("body").off("click", ".page");
            this.pageNavigator = $("body").on("click", ".page", function() {
              var el = $(this);
              that.goToPage(el.data("page"));
            });
          },
          navigate: function(next) {
            // default perPage to 5
            if (isNaN(next) || next === undefined) {
              next = true;
            }
            $(".pagination-nivel .nav").parent().removeClass("disabled");
            if (next) {
              this.currentPage++;
              if (this.currentPage > (this.totalPages - 1))
                this.currentPage = (this.totalPages - 1);
              if (this.currentPage == (this.totalPages - 1))
                $(".pagination-nivel .nav.next").parent().addClass("disabled");
              }
            else {
              this.currentPage--;
              if (this.currentPage < 0)
                this.currentPage = 0;
              if (this.currentPage == 0)
                $(".pagination-nivel .nav.prev").parent().addClass("disabled");
              }

            this.showItems();
          },
          updateNavigation: function() {

            var pages = $(".pagination-nivel .page");
            pages.removeClass("current");
            pages.parent().removeClass("active");

            $('.pagination-nivel .page[data-page="' + (this.currentPage + 1) + '"]').addClass("current");
            $('.pagination-nivel .page[data-page="' + (this.currentPage + 1) + '"]').parent().addClass("active");
          },
          goToPage: function(page) {

            this.currentPage = page - 1;

            $(".pagination-nivel .nav").removeClass("disabled");
            if (this.currentPage == (this.totalPages - 1))
              $(".pagination-nivel .nav.next").addClass("disabled");

            if (this.currentPage == 0)
              $(".pagination-nivel .nav.prev").addClass("disabled");
            this.showItems();
          },
          showItems: function() {
            this.items.hide();
            var base = this.perPage * this.currentPage;
            this.items.slice(base, base + this.perPage).show();

            this.updateNavigation();
          },
          init: function(container, items, perPage) {
            this.container = container;
            this.currentPage = 0;
            this.totalPages = 1;
            this.perPage = perPage;
            this.items = items;
            this.createNavigation();
            this.showItems();
          }
        };

        // stuff it all into a jQuery method!
        $.fn.pagifyNivel = function(perPage, itemSelector) {
          var el = $(this);
          var items = $(itemSelector, el);

          // default perPage to 5
          if (isNaN(perPage) || perPage === undefined) {
            perPage = 3;
          }

          // don't fire if fewer items than perPage
          if (items.length <= perPage) {
            return true;
          }

          pagifyNivel.init(el, items, perPage);
        };
      })(jQuery);

      $(".product-list-nivel").pagifyNivel(8, ".product-container-nivel");

    });

  </script>
@endsection