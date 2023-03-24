<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=1.4"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style type="text/css">
      .collapsible-header {
        color: rgba(0,0,0,0.87);
        font-weight: 500;
        padding: 0 32px !important;
      }
    </style>

  </head>

  <body>

    <div class="container header">
      <div class="row mb-0 flex">
        <div class="col s2">
          <a href="{{ route('inicio') }}" class="logo">
            <img src="{{ asset('img/logo.png') }}" class="responsive-img">
          </a>
        </div>
        <div class="col s10 valign-wrapper">
          <div class="row mb-0">
            <!-- atencion al cliente -->
            <div class="col hide-on-small-only m7 l5 atencion-cliente">
              <div class="row mb-0">
                <div class="col s3">
                  <img src="{{ asset('img/telefono.png') }}">
                </div>
                <div class="col s9">
                  <p class="ma-0">
                    Atención al cliente<br>
                    <span>{{ $configuraciones->telefono3 }}</span>
                  </p>
                </div>
              </div>              
            </div>
            <!-- end atencion al cliente -->

            <!-- buscar -->
            <div class="col s4 hide-on-med-and-down buscar">
              <div class="input-field ma-0">
                <form role="form" method="GET" action="{{ route('buscar') }}">
                  <input id="search" type="text" name="buscar" placeholder="Buscar">
                  <button type="submit" class="btn-flat"><i class="material-icons">search</i></button>
                </form>                
              </div>
            </div>
            <!-- end buscar -->

            <div class="col s8 m5 l3 right redes-sociales pr-4">
              <div class="row ml-0 mr-0">
                <div class="col s12 right-align pa-0">

                  @if ($configuraciones->instagram != '')
                    <a href="{{ $configuraciones->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                  @endif

                  @if ($configuraciones->facebook != '')
                    <a href="{{ $configuraciones->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
                  @endif

                  @if ($configuraciones->twitter != '')
                    <a href="{{ $configuraciones->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                  @endif

                  @if ($configuraciones->youtube != '')
                    <a href="{{ $configuraciones->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="transparent z-depth-0">
      <div class="container menu">
        <div class="nav-wrapper">
          <div class="row">
            <div class="col s12">
              <a href="{{ route('inicio') }}" class="brand-logo">
                <img src="{{ asset('img/logo2.png') }}">
              </a>
              <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

              <style>
                .dropdown-content {
                  width: 200px !important;
                }
              </style>

              <ul class="left menu-left hide-on-med-and-down">

                <li><a href="{{ route('inicio') }}">INICIO</a></li>
                
                <li>
                  <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                    PRODUCTOS
                    <i class="material-icons right">arrow_drop_down</i>
                  </a>
                  <ul id="dropdown1" class="dropdown-content">
                    <li><a href="{{ route('productos') }}">Todos los productos</a></li>
                    <li class="divider"></li>
                    @foreach ($categorias as $item)
                      <li><a href="{{ route('productos.categoria', $item->url) }}">{{ $item->nombre }}</a></li>
                    @endforeach
                  </ul>
                </li>

                <li><a href="{{ route('filosofia') }}">FILOSOF&Iacute;A</a></li>
                <li><a href="{{ route('blog') }}">BLOG</a></li>
                <li><a href="{{ route('contacto') }}">CONTACTO</a></li>
              </ul>
              <ul class="right hide-on-med-and-down">

                @if (Auth::guard('clientes')->check())
                  <li>
                    <a class="dropdown-trigger" href="#!" data-target="dropdown2"><i class="fas fa-user"></i> MI CUENTA
                      <i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="dropdown2" class="dropdown-content" tabindex="0" style="">
                      <li tabindex="0"><a href="{{ route('clientes.perfil') }}">Mi perfil</a></li>
                      <li tabindex="0"><a href="{{ route('clientes.pedidos') }}">Mis pedidos</a></li>
                      <li class="divider"></li>
                      <li tabindex="0"><a href="{{ route('clientes.logout') }}">Cerrar sesión</a></li>
                    </ul>
                  </li>
                @else
                  <li><a href="{{ route('clientes.login') }}"><i class="fas fa-user"></i> LOGIN</a></li>
                @endif               

                <li class="separador">|</li>
                <li>
                  <a href="{{ route('carrito') }}">
                    <span class="cart-button">CARRITO DE COMPRAS <i class="fas fa-shopping-cart"></i></span>
                    <span id="cart-number" class="cart-number" data-count="0">0</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
      <li><a href="{{ route('inicio') }}">INICIO</a></li>

      <ul class="collapsible">
        <li>
          <div class="collapsible-header">PRODUCTOS <i class="material-icons right">arrow_drop_down</i></div>
          <div class="collapsible-body">
            <ul>
              <li class="divider"></li>
              <li><a href="{{ route('productos') }}">Todos los productos</a></li>
              
              @foreach ($categorias as $item)
                <li><a href="{{ route('productos.categoria', $item->url) }}">{{ $item->nombre }}</a></li>
              @endforeach
              <li class="divider"></li>
            </ul>
          </div>
        </li>        
      </ul>

      <li><a href="{{ route('filosofia') }}">FILOSOF&Iacute;A</a></li>
      <li><a href="{{ route('blog') }}">BLOG</a></li>
      <li><a href="{{ route('contacto') }}">CONTACTO</a></li>
      <li><div class="divider"></div></li>
      <li><a href="{{ route('clientes.login') }}"><i class="fas fa-user"></i> LOGIN</a></li>
      <li><a href="{{ route('carrito') }}"><i class="fas fa-shopping-cart"></i> CARRITO DE COMPRAS</a></li>
    </ul>

    @yield('contenido')

    <footer class="page-footer">
      <div class="container">
        <div class="row flex">
          <div class="col l4">
            <h5>Nuestras tiendas</h5>
            <ul>
              <li>
                {{ $configuraciones->direccion1 }}
                <br>
                <span>{{ $configuraciones->telefono1 }}</span>
                <br>
                <span>{{ $configuraciones->email1 }}</span>
              </li>
            </ul>
          </div>
          <div class="col l4">
            <h5 class="hide-on-med-and-down">&nbsp;</h5>
            <ul>
              <li>
                {{ $configuraciones->direccion2 }}
                <br>
                <span>{{ $configuraciones->telefono2 }}</span>
                <br>
                <span>{{ $configuraciones->email2 }}</span>
              </li>
            </ul>
          </div>
          <div class="col l4 redes-sociales valign-wrapper">
            <div class="row mb-0">
              <div class="col s12 redes-container">

                @if ($configuraciones->instagram != '')
                  <a href="{{ $configuraciones->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                @endif

                @if ($configuraciones->facebook != '')
                  <a href="{{ $configuraciones->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
                @endif

                @if ($configuraciones->twitter != '')
                  <a href="{{ $configuraciones->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                @endif

                @if ($configuraciones->youtube != '')
                  <a href="{{ $configuraciones->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>     
    </footer>

    <!-- Floating button -->
    <!--
    <div class="fixed-action-btn horizontal direction-top hide-on-large-only">
      <a class="btn-floating btn-large red pulse tooltipped" data-position="left" data-delay="50" data-tooltip="Atencion al Cliente">
        <i class="large material-icons">menu</i>
      </a>
      <ul>
        <li>
          <a class="btn-floating tooltipped blue" href="https://gitter.im/Dogfalo/materialize" data-position="left" data-delay="50" data-tooltip="Dejanos un mensaje"><i class="material-icons">chat</i></a>
        </li>
        <li>
          <a class="btn-floating tooltipped green" href="tel:15558675309" data-position="left" data-delay="50" data-tooltip="Llamanos"><i class="material-icons">phone</i></a>
        </li>
      </ul>
    </div>
    -->

    <!-- Modal -->
    <div id="modal-cart" class="modal modal-cart">
      <div class="modal-content">
        <h4><i class="large material-icons">check_circle</i></h4>
        <p>Producto agregado al carrito</p>
        <a href="{{ route('carrito') }}" class="waves-effect waves-light btn modal-cart-button">
          <i class="material-icons left">shopping_cart</i>
          Ir al carrito
        </a>
        <a class="modal-cart-link modal-action modal-close">Seguir comprando</a>
      </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script type='text/javascript' src="{{ asset('js/paginador.js') }}"></script>

    <script type="text/javascript">

      function carritoConteo() {
        $.ajax({
          url: '{{ route("carrito.conteo") }}',
          type: 'GET',
          success: function(datos) {
            
            if(datos != ''){
              $('#cart-number').attr('data-count', datos);
              $('#cart-number').html(datos);
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          }    
        });
      }

      $(document).ready(function(){

        $(".dropdown-trigger").dropdown();
        $('select').formSelect();
        $('.collapsible').collapsible();

        $('#modal-cart').modal();
        //$('#modal-cart').modal('open');

        carritoConteo();

        $(window).scrollTop(0);

        $('.sidenav').sidenav({
          closeOnClick: true
        });

        $('.fixed-action-btn').floatingActionButton();
        $('.tooltipped').tooltip();

        $('.tabs').tabs();
      });

      var header = $('header');
      var nav = $('nav');
      var navBg = $('#nav-bg');
      var range = 200;

      $(window).on('scroll', function() {
        
        var scrollTop = $(this).scrollTop();
        var height = header.outerHeight();
        var offset = height / 1.1;
        var calc = 1 - (scrollTop - offset + range) / range;

        var navBgPos = parseInt(navBg.css('top'), 10);
        var navPos = parseInt(nav.css('top'), 10);

        if(navBgPos - scrollTop > 0){
          nav.css({'top': navPos - scrollTop});
          navBg.css({'top': navBgPos - scrollTop});
        }
        else{
          nav.css({'top': 0});
          navBg.css({'top': 0});
        }
        
        if(scrollTop == 0){
          nav.css({'top': '92px'});
          navBg.css({'top': '92px'});
        }

        header.css({'opacity': calc});

        if (calc > '1') {
          header.css({'opacity': 1});
          $('.brand-logo img').attr('src', '{{ asset("img/logo2.png") }}');
          $('nav ul a').css('color', '#fff');
          $('nav .cart-button').css('border-color', '#fff');
          $('nav .separador').css('color', '#fff');
          $('nav a').css('color', '#fff');
        } 
        else if (calc < '0') {
          header.css({'opacity': 0});
          $('.brand-logo img').attr('src', '{{ asset("img/logo3.png") }}');
          $('nav ul a').css('color', '#f7922f');
          $('nav .cart-button').css('border-color', '#f7922f');
          $('nav .separador').css('color', '#f7922f');
          $('nav a').css('color', '#f7922f');
        }
        
      });
    </script>

    @yield('script')

  </body>
</html>