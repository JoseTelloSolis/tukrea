@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      padding: 100px 0;
      height: 0;
    }
  </style>

  <header>
    <div class="container">
      <h1></h1>
      <p></p>
    </div>
  </header>

  <div id='nav-bg'></div>

  <section class="content first mi-carrito">
    <div class='container'>   
      <div class="row">
        <div class="col m6 padding-login">
          <h2>¿Ya tienes una cuenta?</h2>
          <p>Debe ingresar con su email y contraseña para poder realizar pedidos</p>

          @if (session('mensajeLogin'))
          <p style="color:red" id="mensaje-login">{{ session('mensajeLogin') }}</p>
          @else
          <p style="color:red" id="mensaje-login"></p>
          @endif

          <form id="form-login" class="form-login" method="POST" action="{{ route('clientes.postLogin') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="email" name="email" required>
                <label for="email">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="password" class="validate" id="password" name="password" required>
                <label for="password">Contraseña</label>
              </div>
            </div>

            <a href="{{ route('cliente.password.reset') }}" class="olvidar-pass">¿Olvidaste tu contraseña?</a>

            <button type="submit" class="boton boton-full login waves-effect waves-light btn">Ingresar <i class="fas fa-sign-in-alt"></i></button>

            <p class="titulo-lineas">o</p>

            <a href="{{ route('facturacion') }}" class="boton boton-full boton-bloque invitado waves-effect waves-light btn">Comprar como invitado <i class="fas fa-walking"></i></a>

          </form>

        </div>

        <div class="col m6 padding-login column-line">
          <h2>¿No estás registrado?</h2>
          <p>Regístrate y disfrutarás de una experiencia de compra más rápida</p>

          <p style="color:red" id="validacion"></p>

          @if (session('mensaje'))
          <p style="color:red" id="mensaje">{{ session('mensaje') }}</p>
          @else
          <p style="color:red" id="mensaje"></p>
          @endif

          <form id="form-registro" class="form-login" method="POST" action="{{ route('clientes.registro') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="email-registro" name="email" required>
                <label for="email-registro">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="nombre" name="nombre" required>
                <label for="nombre">Nombre</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="apellidos" name="apellidos" required>
                <label for="apellidos">Apellidos</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="password" class="validate" id="password-registro" name="password" required>
                <label for="password-registro">Contraseña</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="password" class="validate" id="repeat-password" name="repeat-password" required>
                <label for="repeat-password">Repetir Contraseña</label>
              </div>
            </div>

            <button type="submit" class="boton boton-full login waves-effect waves-light btn">Registrarse <i class="fas fa-sign-in-alt"></i></button>

          </form>

        </div>

      </div>
    </div>
  </section>

@endsection

@section('script')        
            
  <script type="text/javascript">

    $(document).ready(function() {

      setTimeout(function(){
        $('#mensaje').html('');
        $('#mensaje-login').html('');
      }, 4000);

      $('#form-registro').on('submit', function(e){
        e.preventDefault();

        var password = $('#password-registro').val();
        var repeatPassword = $('#repeat-password').val();

        if(password == repeatPassword){
          $('#form-registro')[0].submit();
        }
        else {
          $('#validacion').html('Las contraseñas no coinciden');
          
          setTimeout(function(){
            $('#validacion').html('');
          }, 4000);
        }
        
      });

    });
  </script>     

@endsection