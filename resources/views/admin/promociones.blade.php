@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <form id="formulario" class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.promociones.editar') }}" enctype="multipart/form-data">

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <!-- boton -->
              <div class="div-boton">
                <button type="submit" class="btn btn-success" id="guardar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Guardar Datos</button>
              </div>
              <!-- fin boton --> 

              @if (session('mensaje'))
                <div class="alert alert-success alert-dismissible fade show text-left"
                role="alert">
                  {{ session('mensaje') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                      &times;
                    </span>
                  </button>
                </div>
              @endif
              
              <!--contenido -->
              <div class="card card-primary">
      
                <div class="card-header">
                  <div class="panel-title">Productos en promoción</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-lg-12">

                      <input type="hidden" id="lista-productos" name="productos" value="{{ $datos->productos }}">

                      <!-- texto multilinea -->
                      <span class="help-block">
                        Elegir productos <span>- maximo 4</span>
                      </span>
                      <div class="input-group mt-2">
                        <select id="select-productos" class="form-control productos" name="id-productos[]" multiple="multiple">
                          @foreach ($productos as $dato)
                            <option value="{{ $dato->id }}">{{ $dato->codigo }} - {{ $dato->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- fin texto multilinea -->

                    </div>
                  </div>   

                
                </div>

              </div>
              <!-- end contenido -->
            </form>

          </div>
        </div>

      </div>
    </div>

  </div>
@endsection

@section('script')

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $('#select-productos').select2();

      var arrayProductos = $('#lista-productos').val().split(',');
      $('#select-productos').val(arrayProductos).trigger('change');

      $('#formulario').submit(function(e) {

        e.preventDefault();

        var productos = $('#select-productos').val();

        var output = '';
        
        for(var i = 0; i < productos.length; i++) {
          output += productos[i] + ',';
        }

        output = output.slice(0, -1);

        $('#lista-productos').val(output);

        $(this).unbind('submit').submit();
      });

    });
  </script>

@endsection