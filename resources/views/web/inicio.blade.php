@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header::before {
      background-image: url('{{ asset($datos->imagen) }}');
    }
    .link-nombre {
      color: rgba(0,0,0,0.87);
    }
  </style>

  <header>
    <div class="container">
      <h1></h1>
      <p></p>
    </div>
  </header>

  <div id='nav-bg'></div>

  @foreach ($categorias as $categoria)

    @php

      $productosCategorias = App\Productos::select()
      ->where('activo', 1)
      ->where('imagen', '!=', '')
      ->where('id_categoria', $categoria->id)
      ->limit(3)
      ->get();

    @endphp

    @if(!$productosCategorias->isEmpty())
      <section class="content first">
        <div class='container'>   
          <div class="row">
            <div class="col s12">
              
              <h3 class="line">{{ $categoria->nombre }}</h3>
              <p class="center">{!! nl2br($categoria->texto) !!}</p>
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

                @forelse ($productosCategorias as $producto)

                  <!-- producto -->
                  <div class="row flex">
                    <div class="col m4">
                      <a href="{{ route('producto', $producto->url) }}">
                        <img src="{{ asset($producto->imagen) }}" class="responsive-img">
                      </a>
                      <div class="button center">
                        <a href="{{ route('producto', $producto->url) }}" class="waves-effect waves-light btn">Ver m&aacute;s</a>
                      </div>                  
                    </div>
                    <div class="col m5 text">
                      <a href="{{ route('producto', $producto->url) }}" class="link-nombre">
                        <h3>{{ $producto->nombre }}</h3>
                      </a>
                      
                      <!--<h4 class="set"><b>25010:</b> 1 unidad<br></h4>

                      <h4 class="set"><b>Packing: </b>Caja</h4>-->

                      <p>{!! nl2br($producto->resumen) !!}</p>

                    </div>
                    <div class="col m3 price center">
                      <div class="input-field col s12">
                        <p class="cod-precio elegir-codigo" data-precio="50.00"><b>{{ $producto->codigo }}:</b> Set de 1 unidad</p>
                      </div>
                      
                      <p class="precio"></p>

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

                          <div class="number-input">
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                            <input class="quantity" name="quantity" value="1" type="number" min="1" max="{{ $configuraciones->productos_maximo }}" readonly>
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                          </div>
                          <div class="button center">
                            <button type="submit" class="waves-effect waves-light btn">Agregar</button>
                          </div> 
                        @else
                          <h4 class="sin-stock">Sin stock</h4>
                        @endif

                      </form>

                    </div>
                  </div>
                  <!-- end producto -->

                  @if(!$loop->last)
                    <hr> 
                  @endif
                  
                @empty

                @endforelse
                              
                <div class="button-plus center">
                  <a href="{{ route('productos.categoria', $categoria->url) }}" class="waves-effect waves-light btn-large"><i class="fas fa-plus"></i></a>
                </div>

              </div>
            </div>

          </div>
        </div>
      </section>
    @endif

  @endforeach

  <section class="content first">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h3 class="line">{{ $datos->titulo4 }}</h3>
          <p class="center">{!! nl2br($datos->texto4) !!}</p>
        </div>
      </div>
    </div>
  </section>

  <section class="blog">
    <div class="container">

      <div class="row flex">

        @foreach ($blog as $dato)
          <!-- blog item -->
          <div class="col s12 m6 l6 xl4">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset($dato->imagen) }}">
              </div>
              <div class="card-title">
                <h3>{{ $dato->titulo }}</h3>
              </div>
              <div class="card-content">
                <p>{{ $dato->resumen }}</p>
              </div>
              <div class="card-action">
                <a href="{{ route('blog.detalle', $dato->url) }}" class="waves-effect waves-light btn"><i class="fas fa-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- end blog item -->
        @endforeach

        <div class="col s12">
          <div class="button-plus">
            <a href="{{ route('blog') }}" class="waves-effect waves-light btn-large"><i class="fas fa-plus"></i></a>
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

    });
  </script>
@endsection