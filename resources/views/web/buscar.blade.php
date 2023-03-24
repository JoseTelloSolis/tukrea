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

  <section class="content first last">
    <div class='container'>   
      <div class="row">
        <div class="col s12">
          <h3>Productos encontrados:</h3>
        </div>
      </div>       
    </div>
  </section>

  <section class="section-tabs">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <ul class="tabs">
            <li class="tab col s3"><a href="#test1" class="active">INDIVIDUAL</a></li>
          </ul>
        </div>
        <div id="test1" class="col s12">
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

            <div class="row product-list">

              @forelse ($productos as $producto)
                <!-- producto -->
                <div class="product-container">
                  <div class="col m4 product-image">
                    <a href="{{ route('producto', $producto->url) }}">
                      <img src="{{ asset($producto->imagen) }}" class="responsive-img">
                    </a>
                    <div class="center title hide">
                      <a href="{{ route('producto', $producto->url) }}">
                        <h3>{{ $producto->nombre }}</h3>
                      </a>
                    </div>
                    <div class="button center button-image">
                      <a href="{{ route('producto', $producto->url) }}" class="waves-effect waves-light btn">Ver m&aacute;s</a>
                    </div>                  
                  </div>
                  <div class="col m5 text product-text">
                    <h3>{{ $producto->nombre }}</h3>
                    <p>{!! nl2br($producto->resumen) !!}</p>
                  </div>
                  <div class="col m3 price center product-price">
                    <div class="product-price-money">
                      <p>S/ {{ $producto->precio }}</p>
                    </div>  

                    <form class="formulario"> 

                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="idx" value="{{ $producto->id }}">   

                      <input type="hidden" id="input-color" name="color">

                      @if ($producto->activar_colores == true)
                        <input type="hidden" id="activar-colores" name="activar_colores" value="1">
                      @else
                        <input type="hidden" id="activar-colores" name="activar_colores" value="0">
                      @endif

                      @if ($producto->activar_tallas == true)
                        <input type="hidden" id="activar-tallas" name="activar_tallas" value="1">
                      @else
                        <input type="hidden" id="activar-tallas" name="activar_tallas" value="0">
                      @endif         

                      @if ($producto->stock > 0)  
                        <div class="product-price-value">
                          <div class="number-input">
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                            <input class="quantity" min="0" name="quantity" value="1" type="number">
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
              @empty
              @endforelse

              <div class="col s12 div-pagination">
                <ul class="pagination right">
                  
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
    $(document).ready(function(){

      $('.formulario').submit(function(e) {

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
        $('.product-container .product-price').removeClass('m12').addClass('m3');
        
        $('.product-container .product-price-money').removeClass('col s5');  
        $('.product-container .product-price-value').removeClass('col s7');  
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
        $('.product-container .product-price').removeClass('m3').addClass('m12');

        $('.product-container .product-price-money').addClass('col s5');  
        $('.product-container .product-price-value').addClass('col s7');  
        $('.product-container .product-image .button-image').addClass('hide');
        $('.product-container .product-image .title').removeClass('hide');   

        $('.product-list hr').addClass('hide'); 
        $('.product-list-nivel hr').addClass('hide');         
      });

      $('.gallery').trigger( "click" );

      //-------------------------------------------
      //paginador
      (function($) {
        var pagify = {
          items: {},
          container: null,
          totalPages: 1,
          perPage: 3,
          currentPage: 0,
          createNavigation: function() {
            this.totalPages = Math.ceil(this.items.length / this.perPage);

            $('.pagination', this.container.parent()).remove();
            var pagination = $('<ul class="pagination right"></ul>').append('<li class="disabled"><a href="javascript:void(0)" class="nav prev" data-next="false"><i class="material-icons">chevron_left</i></a></li>');

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

            $('.div-pagination').html(pagination);

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
            $(".pagination .nav").parent().removeClass("disabled");
            if (next) {
              this.currentPage++;
              if (this.currentPage > (this.totalPages - 1))
                this.currentPage = (this.totalPages - 1);
              if (this.currentPage == (this.totalPages - 1))
                $(".pagination .nav.next").parent().addClass("disabled");
              }
            else {
              this.currentPage--;
              if (this.currentPage < 0)
                this.currentPage = 0;
              if (this.currentPage == 0)
                $(".pagination .nav.prev").parent().addClass("disabled");
              }

            this.showItems();
          },
          updateNavigation: function() {

            var pages = $(".pagination .page");
            pages.removeClass("current");
            pages.parent().removeClass("active");

            $('.pagination .page[data-page="' + (this.currentPage + 1) + '"]').addClass("current");
            $('.pagination .page[data-page="' + (this.currentPage + 1) + '"]').parent().addClass("active");
          },
          goToPage: function(page) {

            this.currentPage = page - 1;

            $(".pagination .nav").removeClass("disabled");
            if (this.currentPage == (this.totalPages - 1))
              $(".pagination .nav.next").addClass("disabled");

            if (this.currentPage == 0)
              $(".pagination .nav.prev").addClass("disabled");
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
        $.fn.pagify = function(perPage, itemSelector) {
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

          pagify.init(el, items, perPage);
        };
      })(jQuery);

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

      $(".product-list").pagify(8, ".product-container");
      $(".product-list-nivel").pagifyNivel(8, ".product-container-nivel");
    });

  </script>
@endsection