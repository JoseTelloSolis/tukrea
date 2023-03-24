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
			<div class="titulo8"> 			
				<h1>{{ $datos->titulo }}</h1>
			</div>
			<div class="post-118 post type-post status-publish format-standard hentry category-coding category-news category-web-design tag-coding tag-graphic-design tag-iphone tag-mobile">
				<div class="item-container">
					<div class="item-container-image item-container-spacer">
						<img width="1120" height="440" src="{{ asset($datos->imagen) }}" class="attachment-blog-image wp-post-image" alt="" title="">
					</div>
					<div class="item-container-content" style="margin-top:60px">
						<div class="titulo9"> 			
							{!! $datos->texto !!}
						</div>
					</div><!-- close .item-container-content -->
				</div><!-- close .item-container -->
			</div><!-- close .blog-post --><!-- close .blog-post --><!-- close .blog-post --><!-- close .blog-post -->
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