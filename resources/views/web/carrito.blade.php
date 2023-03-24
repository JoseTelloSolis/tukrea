@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      padding: 100px 0;
      height: 0;
    }
    .form-carrito {
      width: 100%;
      overflow-x: scroll;
    }
    .form-carrito::-webkit-scrollbar {
    -webkit-appearance: none;
    }

    .form-carrito::-webkit-scrollbar:vertical {
        width: 11px;
    }

    .form-carrito::-webkit-scrollbar:horizontal {
        height: 11px;
    }

    .form-carrito::-webkit-scrollbar-thumb {
        border-radius: 8px;
        border: 2px solid white; /* should match background, can't be transparent */
        background-color: rgba(0, 0, 0, .5);
    }
    section.content {
      font-size: 16px;
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
        <div class="col s12">
          <h2>Mi Carrito</h2>

          <div class="item-container tabla-container carrito-container">

            <div class="div-loader-tabla">
              <div class="loader"></div>
            </div>
                    
            <form action="" method="post" class="form-carrito">
              <table class="shop_table cart" cellspacing="0">
                <thead>
                  <tr>
                    <th class="product-name">NOMBRE DEL PRODUCTO</th>
                    <th class="product-quantity">CANTIDAD</th>
                    <th class="product-price">PRECIO</th>
                    <th class="product-eliminar">ELIMINAR</th>
                  </tr>
                </thead>
                <tbody id="carrito-tabla">     
                  
                </tbody>
              </table>
            </form>
            <div class="cart-collaterals">

              <h2>TOTAL</h2>

              <div class="cart_totals ">
                <table cellpadding="0" cellspacing="0" id="totales">
                  <tbody>
                    <tr class="total">
                      <th><strong class="big">Total del pedido</strong></th>
                      <td class="td-monto"><span class="monto"><strong id="monto" class="big"></strong></span></td>
                    </tr>
                    <tr>
                      <td colspan="6" class="actions">
                        <a href="{{ route('clientes.login') }}" class="carrito-comprar-btn right waves-effect waves-light btn">
                          Proceder con la compra
                        </a>
                      </td>
                    </tr>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div id="modal-eliminar" class="modal modal-cart">
    <div class="modal-content">
      <input type="hidden" id="codigo-tabla-delete">
      <p>¿Esta seguro que desea eliminar este producto de su carrito de compras?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-light btn">Cancelar</a>
      <a id="btn-carrito-tabla-eliminar" class="btn-carrito-tabla-eliminar waves-effect waves-light btn">Eliminar</a>
    </div>
  </div>

@endsection

@section('script')        
            
  <script type="text/javascript">

    function carrito(){

      $('.div-loader-tabla').show();

      $.ajax({
        url: '{{ route("carrito.tabla") }}',
        type: 'GET',
        success: function(datos) {

          if(datos != ''){
            $("#carrito-tabla").html(datos);
            $('.div-loader-tabla').hide();
          }
          else{
            $("#carrito-tabla").html('<tr><td colspan="4">No hay productos en su mochila</td></tr>');
            $('.div-loader-tabla').hide();
          }
        },       
        error: function(xhr) {
          console.log('Ocurrio un error.');
        }    
      });

      $.ajax({
        url: '{{ route("carrito.total") }}',
        type: 'GET',
        success: function(datos) {
          
          if(datos != ''){
            $("#monto").html('S/ ' + datos);
          }
        },       
        error: function(xhr) {
          console.log('Ocurrio un error.');
        }    
      });
    }

    $(document).ready(function() {

      $('#modal-eliminar').modal();
      carrito();

      $('body').on('click', '.carrito-tabla-delete', function(e){

        e.preventDefault();

        var codigo = $(this).attr('data-codigo');
        $('#codigo-tabla-delete').val(codigo);

        $('#modal-eliminar').modal('open');
        
      });

      $('#btn-carrito-tabla-eliminar').click(function(){

        var codigo = $('#codigo-tabla-delete').val();

        var parametros = {
          'codigo' : codigo
        };
        
        $.ajax({
          url: '{{ route("carrito.delete") }}',
          type: 'GET',
          data:  parametros,
          success: function(datos) {
            
            if(datos == 'ok'){
              carrito();

              $('#modal-eliminar').modal('close');
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          }    
        });
      });

      $('body').on('click', '.number-input button', function(){
        $('.div-loader-tabla').show();

        var codigo = $(this).parent().find('.carrito-tabla-cantidad').attr('data-codigo'); 
        var cantidad = $(this).parent().find('.carrito-tabla-cantidad').val();

        var parametros = {
          'codigo' : codigo,
          'cantidad' : cantidad
        };
        
        $.ajax({
          url: '{{ route("carrito.update") }}',
          type: 'GET',
          data:  parametros,
          success: function(datos) {
            
            if(datos == 'ok'){
              carrito();
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          }    
        });
      })

      $('body').on('change', '.carrito-tabla-cantidad', function(){

        $('.div-loader-tabla').show();

        var codigo = $(this).attr('data-codigo'); 
        var cantidad = $(this).val();

        var parametros = {
          'codigo' : codigo,
          'cantidad' : cantidad
        };
        
        $.ajax({
          url: '{{ route("carrito.update") }}',
          type: 'GET',
          data:  parametros,
          success: function(datos) {
            
            if(datos == 'ok'){
              carrito($);
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          }    
        });
        
      });

    });
  </script>     

@endsection