@extends('admin.plantilla')

@section('contenido')
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">

            <form class="form form-horizontal periodico" role="form" method="POST" action="{{ route('admin.tarifario.editar') }}" enctype="multipart/form-data">

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

              <div id="alert"></div>
              
              <!--contenido -->
              <div class="card card-primary">
      
                <div class="card-header">
                  <div class="panel-title">Tarifario Delivery - Distrito de Lima</div>
                </div>  
                
                <div class="card-body">

                  <div class="row">

                    @foreach($datos as $dato)

                      <div class="col-md-6 col-lg-4">                        

                        <!-- texto linea simple -->
                        <span class="help-block">
                          {{ $dato->name }}
                        </span>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                          <input type="text" class="form-control costo" name="costo" data-id="{{ $dato->id }}" data-costo="{{ $dato->costo }}" value="{{ $dato->costo }}">
                        </div>
                        <!-- fin texto linea simple -->

                      </div>
                      
                    @endforeach
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

  <script type="text/javascript">
    function showAlert(obj){
      var html = '<div class="alert alert-' + obj.class + ' alert-dismissible" role="alert">'+
          '   <strong>' + obj.message + '</strong>'+
          '       <button class="close" type="button" data-dismiss="alert" aria-label="Close">'+
          '           <span aria-hidden="true">×</span>'+
          '       </button>'
          '   </div>';

      $('#alert').append(html);
    }

    $(document).ready(function() {
      
      $('form').submit(function(e){
        e.preventDefault();

        var listado = [];

        $('.costo').each(function(){
          var id = $(this).attr("data-id");
          var costoOriginal = $(this).attr("data-costo");
          var costo = $(this).val();
          
          if(costoOriginal != costo) {
            item = {};
            item['id'] = id;
            item['costo'] = costo;
            listado.push(JSON.stringify(item));
          }
        });

        $.ajax({
          data:  {'listado[]': listado},
          url:   "{{ route('admin.tarifario.editar') }}",
          type:  'get',
          beforeSend: function() {
            console.log("procesando");
          },
          success: function(datos) {
            console.log(datos);
            //completo
            if(datos == 'ok'){
              showAlert({message: 'Datos actualizados', class:"success"});
            }
            else{
              //los datos son incorrectos
              showAlert({message: 'No se pudo guardar', class:"danger"});
            }
          },
          error: function(xhr) {
            console.log("error");
          }
        });
      });

    });
  </script>

@endsection