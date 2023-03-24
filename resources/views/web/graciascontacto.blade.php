@extends('web.plantilla')


@section('contenido')
  
  <div class="container">
    
    <div class="grid1column login-first-column" style="text-align: center;">
      <h2>Su mensaje ha sido enviado</h2>
      <p>En breve le responderemos...</p>

      <a href="{{ route('inicio') }}">Volver al inicio</a>

    </div>

    <div class="clearfix"></div>
      
  </div>


@endsection

@section('script')

<script type="text/javascript">
    jQuery(document).ready(function($) {

      function animateHover(element, first, second ){
        if( $.browser.version == '8.0' ) {
          $(element).hover(function(){
            $(first, this).show(); 
            $(second, this).hide(); 
          }, function(){
            $(first, this).hide(); 
            $(second, this).show(); 
          });
        }
        else{
          $(element).hover(function(){
            $(first, this).fadeIn(); 
            $(second, this).fadeOut(); 
          }, function(){
            $(first, this).fadeOut();
            $(second, this).fadeIn(); 
          });
        }
      }

      /* HOVER BOTON ANIMATED  */    
      animateHover('.hoverAnimated', '.second', '.first');
        $('.flexslider').flexslider({
        animation: "fade",              
        slideDirection: "horizontal",   
        slideshow: true,                
        slideshowSpeed: 6500,           
        animationDuration: 500,         
        directionNav: false,             
        controlNav: true,             
        keyboardNav: true,             
        mousewheel: false,             
        prevText: "Previous",           
        nextText: "Next",               
        pausePlay: false,               
        pauseText: 'Pause',            
        playText: 'Play',               
        randomize: false,              
        slideToStart: 0,                
        useCSS: true,
        animationLoop: true,            
        pauseOnAction: true,            
        pauseOnHover: false            
      });
    });
  </script>

@endsection