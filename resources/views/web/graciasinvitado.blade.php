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
        <div class="col m12 text-center">
          <h2>Gracias por su compra</h2>
          <p>Para conocer el estado de tu pedido, por favor revisa tu correo.</p>

          <a href="{{ route('inicio') }}">Volver al inicio</a>

        </div>

      </div>
    </div>
  </section>

@endsection