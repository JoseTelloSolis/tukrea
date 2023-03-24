@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      padding: 100px 0;
      height: auto;
      background-color: #ccc;
    }
    header::before {
      background-image: url({{ asset("img/bg-producto.jpg") }});
    }
    .carousel {
      width: 100%;
    }
    .carousel-item img{
      width: 85% !important;
    }
  </style>

  <header>
    <div class="container relative">
      <div class="row">
        <div class="col s12 m12 l8 carousel-container">
          <div class="carousel carousel-slider center"> 

            <div class="carousel-fixed-item center middle-indicator">
              <div class="left">
                <a href="Previo" class="movePrevCarousel middle-indicator-text waves-effect waves-light content-indicator"><i class="material-icons left  middle-indicator-text">chevron_left</i></a>
              </div>

              <div class="right">
                <a href="Siguiente" class=" moveNextCarousel middle-indicator-text waves-effect waves-light content-indicator"><i class="material-icons right middle-indicator-text">chevron_right</i></a>
              </div>
            </div>     

            <div class="carousel-item" href="#1!">
              <img src="{{ asset($datos->imagen) }}">
            </div>
            @forelse($imagenes as $imagen)
              <div class="carousel-item" href="#{{ $loop->iteration + 1 }}!">
                <img src="{{ asset($imagen->imagen) }}">
              </div>
            @empty
            @endforelse
          </div>
        </div>

        <div class="col s12 m12 l4">
          <div class="product-detail price center product-price">
            <h3>{{ $datos->nombre }}</h3>
            <p>{!! nl2br($datos->resumen) !!}</p>
            
            <div class="product-price-money">
              <p>S/ {{ $datos->precio }}</p>
            </div>   

            <form id="formulario"> 

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="idx" value="{{ $datos->id }}">   

              <input type="hidden" id="input-color" name="color">

              @if ($datos->activar_colores == true)
                <input type="hidden" id="activar-colores" name="activar_colores" value="1">
              @else
                <input type="hidden" id="activar-colores" name="activar_colores" value="0">
              @endif

              @if ($datos->activar_tallas == true)
                <input type="hidden" id="activar-tallas" name="activar_tallas" value="1">
              @else
                <input type="hidden" id="activar-tallas" name="activar_tallas" value="0">
              @endif        

              @if ($datos->stock > 0)  
                <div class="product-price-value">
                  <div class="number-input">
                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                    <input class="quantity" name="quantity" value="1" type="number" min="1" max="{{ $configuraciones->productos_maximo }}" readonly>
                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                  </div>
                  <div class="button center">
                    <button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">shopping_cart</i> Agregar al carrito</button>
                  </div> 
                </div>
              @else
                <h4 class="sin-stock">Sin stock</h4>
              @endif
            </form>

            <div class="row carousel-gallery">
              <div class="col s3">
                <div class="image-container" data-rel="1">
                  <img src="{{ asset($datos->imagen) }}" class="responsive-img">
                </div>
              </div>

              @forelse($imagenes as $imagen)
                <div class="col s3">
                  <div class="image-container" data-rel="{{ $loop->iteration + 1 }}">
                    <img src="{{ asset($imagen->imagen) }}" class="responsive-img">
                  </div>
                </div>
              @empty
              @endforelse              
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div id='nav-bg'></div>

  <section class="content first last">
    <div class='container'>   
      <div class="row">
        <div class="col s12">
          <h3 class="line">Productos Relacionados</h3>
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
            <li class="tab col s3"><a href="#test2">POR NIVELES</a></li>
          </ul>
        </div>
        <div id="test1" class="col s12">
          <div class="tab-content border">

            <!-- buscador -->
            <div class="row">
              <div class="col s12 right-align">
                <a href="#" class="list waves-effect waves-light list-button active"><i class="fas fa-th-list"></i></a>
                <a href="#" class="gallery waves-effect waves-light list-button"><i class="fas fa-th-large"></i></a>
                <div class="products buscar">
                  <div class="input-field ma-0">
                    <input id="search" type="text" placeholder="Buscar">
                    <button class="btn-flat"><i class="material-icons">search</i></button>
                  </div>
                </div>                  
              </div>
            </div>
            <!-- end buscador -->

            <hr>

            <div class="row product-list">

              <!-- producto -->
              <!--
              <div class="product-container">
                <div class="col m4 product-image">
                  <img src="img/producto1.png" class="responsive-img">
                  <div class="center title hide">
                    <h3>Lorem ipsum dolor sit amet, consectetuer adipiscing I</h3>
                  </div>
                  <div class="button center button-image">
                    <a href="#" class="waves-effect waves-light btn">Ver m&aacute;s</a>
                  </div>                  
                </div>
                <div class="col m5 text product-text">
                  <h3>Lorem ipsum dolor sit amet, consectetuer adipiscing I</h3>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut</p>
                  <ul>
                    <li>laoreet dolore magna aliquam</li>
                    <li>erat volutpat. Ut wisi enim ad</li>
                    <li>minim veniam, quis nostrud exerci tation </li>
                  </ul>
                </div>
                <div class="col m3 price center product-price">
                  <div class="product-price-money">
                    <p>S/ 50</p>
                  </div>   
                  <div class="product-price-value">
                    <div class="number-input">
                      <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                      <input class="quantity" min="0" name="quantity" value="1" type="number">
                      <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                    </div>
                    <div class="button center">
                      <a href="#" class="waves-effect waves-light btn">Agregar</a>
                    </div> 
                  </div>                
                  
                </div>

                <div class="col s12">
                  <hr>
                </div>
              </div>  -->              
              <!-- end producto -->  
                              
            </div>                          

          </div>
        </div>

        <div id="test2" class="col s12">
          <div class="tab-content border">
            

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')

  <script type="text/javascript">
    $(document).ready(function(){

      $('#formulario').submit(function(e) {

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

      $('.moveNextCarousel').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.carousel').carousel('next');
      });

      // move prev carousel
      $('.movePrevCarousel').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.carousel').carousel('prev');
      });
    });

  </script>
@endsection