@extends('web.plantilla')


@section('contenido')

  <style>
    .hoja {
      width: 100%;
      max-width: 600px;
      padding: 32px;
    }

    .container-mini {
      width: 100%;
    }
  </style>
  
  <div class="container-mini">
    
    <div class="gridcolumn">
    	<h2>RESTAURAR CONTRASEÑA</h2>
    	<p>Ingresa tu correo electrónico y te enviaremos las instrucciones para restaurar tu contraseña.</p>

    	@if (session('mensajeError'))
			 <p style="color:red" id="mensaje-error">{{ session('mensajeError') }}</p>
			@endif

      @if (session('mensaje'))
       <p style="color:green" id="mensaje">{{ session('mensaje') }}</p>
      @endif

    	<form id="formulario" method="POST" action="{{ route('cliente.password.reset') }}">

        <input type="hidden" name="_method" value="PUT">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">

    		<p class="form-row"><br>
          <label>Email</label>
          <input type="text" class="input-text" name="email" id="email">
        </p>

        <button type="submit" class="boton boton-full login mt-10">Restablecer contraseña</button>

        <p class="mt-10">Recuerda revisar tu bandeja de spam.</p>

    	</form>
    </div>


    <div class="clearfix"></div>
      
  </div>


@endsection

@section('script')

<script type="text/javascript">
    jQuery(document).ready(function($) {

    	setTimeout(function(){
				$('#mensaje-error').html('');
			}, 4000);


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