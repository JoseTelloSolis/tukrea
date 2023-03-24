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
    </div>
  </header>

  <div id='nav-bg'></div>

  <section class="content first mi-carrito">
    <div class='container'>   
      <div class="row">
        <div class="col m6 padding-login">
          <h2>Mis Datos</h2>

          @if (session('mensajePerfil'))
            <p style="color:red" id="mensaje-perfil">{{ session('mensajePerfil') }}</p>
          @else
            <p style="color:red" id="mensaje-perfil"></p>
          @endif

          @if (session('mensajePerfilOk'))
            <p style="color:green" id="mensaje-perfil-ok">{{ session('mensajePerfilOk') }}</p>
          @else
            <p style="color:green" id="mensaje-perfil-ok"></p>
          @endif

          <form id="form-perfil" method="POST" action="{{ route('clientes.postPerfil') }}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="email" name="email" value="{{ $cliente->email }}" readonly>
                <label for="email">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="nombre" name="nombre" value="{{ $cliente->nombre }}">
                <label for="nombre">Nombre</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="apellidos" name="apellidos" value="{{ $cliente->apellidos }}">
                <label for="apellidos">Apellidos</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="dni" name="dni" value="{{ $cliente->dni }}">
                <label for="dni">DNI</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="ruc" name="ruc" value="{{ $cliente->ruc }}">
                <label for="ruc">RUC</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="razon_social" name="razon_social" value="{{ $cliente->razon_social }}">
                <label for="razon_social">Razon social</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="telefono" name="telefono" value="{{ $cliente->telefono }}">
                <label for="telefono">Telefono Fijo</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="celular" name="celular" value="{{ $cliente->celular }}">
                <label for="celular">Celular</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <textarea id="direccion" name="direccion" class="materialize-textarea">{{ $cliente->direccion }}</textarea>
                <label for="direccion">Direccion</label>
              </div>
            </div>

            <button type="submit" class="boton boton-full login waves-effect waves-light btn">Actualizar Datos <i class="fas fa-sign-in-alt"></i></button>

          </form>

        </div>

        <div class="col m6 padding-login column-line">
          <h2>Cambiar contraseña</h2>

          <p style="color:red" id="validacion"></p>

          @if (session('mensajePassword'))
            <p style="color:red" id="mensaje-password">{{ session('mensajePassword') }}</p>
          @else
            <p style="color:red" id="mensaje-password"></p>
          @endif

          @if (session('mensajePasswordOk'))
            <p style="color:green" id="mensaje-password-ok">{{ session('mensajePasswordOk') }}</p>
          @else
            <p style="color:green" id="mensaje-password-ok"></p>
          @endif

          <form id="form-password" autocomplete="off" method="POST" action="{{ route('clientes.password') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input autocomplete="false" name="hidden" type="text" style="display:none;">

            <div class="row">
              <div class="input-field col s12">
                <input type="password" class="validate" id="password" name="password" autocomplete="new-password" required>
                <label for="password">Contraseña actual</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="password" class="validate" id="new-password" name="newPassword" autocomplete="new-password" required>
                <label for="new-password">Contraseña nueva</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12">
                <input type="password" class="validate" id="repeat-new-password" name="repeatNewPassword" autocomplete="new-password" required>
                <label for="repeat-new-password">Confirma tu nueva Contraseña </label>
              </div>
            </div>            

            <button type="submit" class="boton boton-full login waves-effect waves-light btn">Cambiar Contraseña <i class="fas fa-sign-in-alt"></i></button>

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
        $('#mensaje-perfil').html('');
        $('#mensaje-perfil-ok').html('');
        $('#mensaje-password').html('');
        $('#mensaje-password-ok').html('');
      }, 4000);

      $('#form-password').on('submit', function(e){
        e.preventDefault();

        var newPassword = $('#new-password').val();
        var repeatNewPassword = $('#repeat-new-password').val();

        if(newPassword == repeatNewPassword){
          $('#form-password')[0].submit();
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