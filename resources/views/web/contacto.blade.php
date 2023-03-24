@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      padding: 100px 0;
      height: auto;
      margin-bottom: 80px;
    }
    header::before {
      background-image: url(img/contacto.jpg);
    }
    .contacto-text h4 {
      color: #ffffff;
      font-size: 30px;
    }

    .contacto-text p {
      text-align: left;
    }
  </style>

  <header>
      <div class="container relative contacto">
        <div class="row">

          <div class="col s12 m12 l6 contacto-text">
            {!! $datos->texto !!}            
          </div>

          <form class="col s12 m12 l6 contacto-form" role="form" method="POST" action="{{ route('contacto.enviar') }}">

            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <h3>Env&iacute;anos un mensaje</h3>
            <div class="input-field">
              <input type="text" name="nombre" class="browser-default" placeholder="Nombres y Apellidos">
            </div>
            <div class="input-field">
              <input type="text" name="telefono" class="browser-default" placeholder="Teléfono">
            </div>
            <div class="input-field">
              <input type="text" name="email" class="browser-default" placeholder="E-mail">
            </div>
            <div class="input-field">
              <textarea name="mensaje" rows="8" class="browser-default" placeholder="Escribir Mensaje"></textarea>
            </div>

            <div class="input-field right">
              <button type="submit" class="waves-effect waves-light btn">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </header>

    <div id='nav-bg'></div>


  @if (session('mensaje'))
    <div id="modal-mensaje" class="modal">
      <div class="modal-content">
        <h4>Mensaje enviado</h4>
        <p>En breve responderemos a su consulta...</p>
      </div>
    </div>
  @endif

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      $('#modal-mensaje').modal();
      $('#modal-mensaje').modal('open'); 

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

        $('.product-container').removeClass('col s12 m3');
        $('.product-container .product-image').removeClass('m12').addClass('m4');
        $('.product-container .product-text').removeClass('hide');
        $('.product-container .product-price').removeClass('m12').addClass('m3');
        
        $('.product-container .product-price-money').removeClass('col s5');  
        $('.product-container .product-price-value').removeClass('col s7');  
        $('.product-container .product-image .button-image').removeClass('hide');
        $('.product-container .product-image .title').addClass('hide'); 

        $('.product-list hr').removeClass('hide');  
      });

      $('.gallery').click(function(e){
        e.preventDefault();

        $('.list').removeClass('active');
        $('.gallery').addClass('active');

        $('.product-container').addClass('col s12 m3');
        $('.product-container .product-image').removeClass('m4').addClass('m12');
        $('.product-container .product-text').addClass('hide');
        $('.product-container .product-price').removeClass('m3').addClass('m12');

        $('.product-container .product-price-money').addClass('col s5');  
        $('.product-container .product-price-value').addClass('col s7');  
        $('.product-container .product-image .button-image').addClass('hide');
        $('.product-container .product-image .title').removeClass('hide');   

        $('.product-list hr').addClass('hide');         
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

      $(".product-list").pagify(4, ".product-container");
    });

  </script>
@endsection