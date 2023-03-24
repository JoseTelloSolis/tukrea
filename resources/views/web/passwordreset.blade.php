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
    	<p>Ingresa una nueva contraseña para su cuenta.</p>

    	@if (session('mensajeError'))
			 <p style="color:red" id="mensaje-error">{{ session('mensajeError') }}</p>
			@endif

      @if (session('mensaje'))
       <p style="color:green" id="mensaje">{{ session('mensaje') }}</p>
       <a href="{{ route('clientes.login') }}">Ir al login de usuario</a>
      @endif

      <p style="color:red" id="mensaje-password-confirmar"></p>

    	<form id="formulario" method="POST" action="{{ route('cliente.putResetPassword') }}">

        <input type="hidden" name="_method" value="PUT">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ request()->get('token') }}">

    		<p class="form-row"><br>
          <label>Email</label>
          <input type="text" class="input-text" name="email" id="email" value="{{ request()->get('email') }}">
        </p>

        <p class="form-row"><br>
          <label>Contraseña nueva</label>
          <input type="password" class="input-text" name="password" id="password">
        </p>

        <p class="form-row"><br>
          <label>Confirma tu nueva contraseña</label>
          <input type="password" class="input-text" name="password-confirmar" id="password-confirmar">
        </p>

        <button type="submit" class="boton boton-full login mt-10">Restaurar contraseña</button>

    	</form>
    </div>


    <div class="clearfix"></div>
      
  </div>


@endsection

@section('script')

<script type="text/javascript">
    jQuery(document).ready(function($) {

    	setTimeout(function(){
				$('#mensaje').html('');
				$('#mensaje-error').html('');
			}, 4000);

      $('#formulario').submit(function(e){
        e.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();
        var passwordConfirmar = $('#password-confirmar').val();

        if(email == ''){
          $('#mensaje-password-confirmar').html('Debe ingresar su email...');
          
          setTimeout(function(){
            $('#mensaje-password-confirmar').html('');
          }, 4000);
          return;
        }

        if(password == passwordConfirmar){
          $('#formulario')[0].submit();
        }
        else {
          $('#mensaje-password-confirmar').html('Las contraseñas no coinciden');
          
          setTimeout(function(){
            $('#mensaje-password-confirmar').html('');
          }, 4000);
        }

      });

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