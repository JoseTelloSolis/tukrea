@extends('admin.plantilla')

@section('contenido')
  
  <style type="text/css">
    #table-responsive tbody tr {
      cursor: pointer;
    }
  </style>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row">
          <div class="col-sm-12">
              
            <!--contenido -->
            <div class="card card-primary">
    
              <div class="card-header">
                <div class="panel-title">Categorias</div>
              </div>  
              
              <div class="card-body">

                <div class="table-responsive">

                  <div class="div-tabla-boton">
                    <a href="{{ route('admin.categorias.crear') }}" class="btn btn-success btn-md mb-2"><i class="fa fa-file"></i> Nueva Categoria</a>
                  </div> 

                  <br>
                            
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

                  <br>

                  <table id="table-responsive" class="table table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Activo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>

                    <tbody>

                      @foreach ($categorias as $dato)                        
                        <tr data-rel="{{ $dato->id }}"> 
                          <td>{{ $dato->nombre }}</td>
                          
                          @if ($dato->activo == 1)
                            <td><span class="badge badge-success">Activo</span></td>
                          @else
                            <td><span class="badge badge-danger">Desactivado</span></td>
                          @endif

                          <td><a href="{{ route('admin.categorias.editar', $dato->id) }}" class="editar boton-editar" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
                          <td><a href="{{ route('admin.categorias.eliminar', $dato->id) }}" class="editar boton-editar eliminar" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                      @endforeach

                    </tbody>                          
                  
                  </table>

                </div>
              
              </div>

            </div>
            <!-- end contenido -->

          </div>
        </div>

      </div>
    </div>

  </div>
@endsection

@section('script')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

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

      $('#table-responsive').on('click', '.eliminar', function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        var confirmacion = confirm("Esta por eliminar una categoria. ¿Aún desea hacerlo?");
        
        if(confirmacion == true) {
          window.location.href = url;
        }
      });

      var fixHelper = function(e, ui) {
        ui.children().each(function() {
          $(this).width($(this).width());
        });
        return ui;
      };

      $("#table-responsive tbody").sortable({
        helper: fixHelper,
        update: function( event, ui ) {
            
          var contador = 1;
          var listado = [];

          $('#table-responsive tbody tr').each(function(){
            var id = $(this).attr("data-rel");
            
            item = {};
            item['orden'] = contador;
            item['id'] = id;
            listado.push(JSON.stringify(item));

            contador++;
          });

          $.ajax({
            data:  {'listado[]': listado},
            url:   "{{ route('admin.categorias.ordenar') }}",
            type:  'get',
            beforeSend: function() {
              console.log("procesando");
            },
            success: function(datos) {
              console.log(datos);
              //completo
              if(datos == 'ok'){
                showAlert({message: 'Datos ordenados', class:"success"});
              }
              else{
                //los datos son incorrectos
                showAlert({message: 'No se pudo ordenar', class:"danger"});
              }
            },
            error: function(xhr) {
              console.log("error");
            }
          });
        }
      }).disableSelection(); 

    });
  </script>
@endsection