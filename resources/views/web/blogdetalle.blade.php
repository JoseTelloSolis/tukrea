@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      padding: 100px 0;
      height: 0;
      margin-bottom: 40px;
    }
    header::before {
      background-image: url('{{ asset($portada->imagen) }}');
    }
    .link-nombre {
      color: rgba(0,0,0,0.87);
    }
    p strong {
      font-weight: bold;
    }
  </style>

  <header>
    <div class="container">
    </div>
  </header>

  <div id='nav-bg'></div>

  <section class="content first">
    <div class="container">   
      <div class="row">
        <div class="col s12">
          <a href="{{ url()->previous() }}" class="btn button-back"><i class="fas fa-angle-left"></i> Volver</a>
          <h3>{{ $datos->titulo }}</h3>
          <img src="{{ asset($datos->imagen) }}" class="newspaper-image">            
          {!! $datos->texto !!}
          
        </div>
      </div>       
    </div>
  </section>

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

    });
  </script>
@endsection