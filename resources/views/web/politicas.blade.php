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
		<div id="container-sidebar">
			<div class="titulo9"> 			
				{!! $datos->texto !!}
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
    jQuery(document).ready(function($) {

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