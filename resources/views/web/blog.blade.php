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
  </style>

  <header>
    <div class="container">
      <h1></h1>
      <p></p>
    </div>
  </header>

  <div id='nav-bg'></div>

  <section class="blog">
    <div class="container">

      <div class="row flex">

        @foreach ($blog as $dato)
          <!-- blog item -->
          <div class="col s12 m6 l6 xl4">
            <div class="card">
              <div class="card-image">
                <img src="{{ asset($dato->imagen) }}">
              </div>
              <div class="card-title">
                <h3>{{ $dato->titulo }}</h3>
              </div>
              <div class="card-content">
                <p>{{ $dato->resumen }}</p>
              </div>
              <div class="card-action">
                <a href="{{ route('blog.detalle', $dato->url) }}" class="waves-effect waves-light btn"><i class="fas fa-plus"></i></a>
              </div>
            </div>
          </div>
          <!-- end blog item -->
        @endforeach

        <div class="col s12">
          {{ $blog->links() }}
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