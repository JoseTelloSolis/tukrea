@extends('web.plantilla')

@section('contenido')

  <style type="text/css">
    header {
      padding: 100px 0;
      height: 0;
    }
    #modal-deposito p {
      font-size: 18px;
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
        <div class="col m12">
          <h2>FINALIZAR COMPRA</h2>

          <p>DATOS DEL DELIVERY</p>
        </div>

        <form id="checkout" class="form-login" method="POST" action="{{ route('pedido.crear') }}">

          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="cliente" value="{{ $cliente->id or '0' }}">
          <input type="hidden" id="delivery" name="delivery" value="0">
          <input type="hidden" id="total" name="total" value="{{ session('total') }}">

          <div class="col m6">

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="nombre" name="nombre" value="{{ $cliente->nombre or '' }}" required>
                <label for="nombre">Nombre <span class="required">*</span></label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="dni" name="dni" value="{{ $cliente->dni or '' }}" required>
                <label for="dni">DNI <span class="required">*</span></label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="telefono" name="telefono" value="{{ $cliente->telefono or '' }}">
                <label for="telefono">Telefono Fijo</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <select id="departamento" name="departamento" class="select departamento">
                  <option value="" disabled selected>Elegir Departamento</option>
                  @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->name }}" data-id="{{ $departamento->id }}">{{ $departamento->name }}</option>
                  @endforeach
                </select>
                <label>Departamento <span class="required">*</span></label>
              </div>
            </div> 

            <div class="row">
              <div class="input-field col s12">
                <select id="distrito" name="distrito" class="select distrito">
                  <option value="" disabled selected>Elegir Distrito</option>
                </select>
                <label>Distrito <span class="required">*</span></label>
              </div>
            </div>   

          </div>

          <div class="col m6">

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="apellidos" name="apellidos" value="{{ $cliente->apellidos or '' }}" required>
                <label for="apellidos">Apellidos <span class="required">*</span></label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="email" name="email" value="{{ $cliente->email or '' }}" required>
                <label for="email">Email <span class="required">*</span></label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" class="validate" id="celular" name="celular" value="{{ $cliente->celular or '' }}" required>
                <label for="celular">Celular <span class="required">*</span></label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <select id="provincia" name="provincia" class="select provincia">
                  <option value="" disabled selected>Elegir Provincia</option>
                </select>
                <label>Provincia <span class="required">*</span></label>
              </div>
            </div>
            
          </div>

          <div class="col m12">
            <div class="row">
              <div class="input-field col s12">
                <textarea id="direccion" name="direccion" class="materialize-textarea">{{ $cliente->direccion or '' }}</textarea>
                <label for="direccion">Dirección <span class="required">*</span></label>
              </div>
            </div>
          </div>

          <div class="col m12">
            <p>DATOS DE FACTURACIÓN</p>

            <p>
              <label>
                <input type="radio" id="radio-boleta" name="boleta_factura" value="boleta" checked>
                <span style="font-size: 20px"><i class="fas fa-file-alt"></i> Boleta</span>
              </label>
            </p>

            <p>
              <label>
                <input type="radio" id="radio-factura" name="boleta_factura" value="factura">
                <span style="font-size: 20px"><i class="far fa-file-alt"></i> Factura</span>
              </label>
            </p>
          </div>

          <div id="div-boleta-factura" class="col m12" style="display:none;">
            <div class="row">
              <div class="input-field col s6">
                <input type="text" class="validate" id="ruc" name="ruc" value="{{ $cliente->ruc or '' }}">
                <label for="ruc">RUC</label>
              </div>

              <div class="input-field col s6">
                <input type="text" class="validate" id="empresa" name="empresa" value="{{ $cliente->razon_social or '' }}">
                <label for="empresa">Razón Social</label>
              </div>
            </div>
          </div>

          <div class="col m12">
            <p>SU PEDIDO</p>

            <table id="cartx" class="shop_table cart" cellspacing="0">
              <thead>
                <tr>
                  <th class="product-name">Producto</th>
                  <th class="product-quantity">Cantidad</th>
                  <th class="product-price">Total</th>
                </tr>
              </thead>
              <tbody>

                @if (session('carrito'))

                  @foreach(session('carrito') as $producto)
                    <tr class="checkout_table_item">
                      <td class="product-name">{{ $producto['nombre'] }}
                        <dl class="variation">
                          <dt>Código:{{ $producto['codigo'] }}</dt>
                        </dl>
                      </td>
                      <td class="product-quantity">{{ $producto['cantidad'] }}</td>
                      <td class="product-total">
                        <span class="monto">
                          <strong>S/. {{ $producto['precio_t'] }}</strong>
                        </span>
                      </td>
                    </tr>
                  @endforeach

                @endif   
                
              </tbody>
              @if (session('total'))
                <tfoot>
                  <tr class="total">
                    <td colspan="2" class="m3"><strong>Total</strong></td>
                    <td><span class="monto"><strong>S/. {{ session('total') }}</strong></span></td>
                  </tr>
                </tfoot>
              @endif
            </table>

            @if (session('total'))
              <input type="hidden" id="pago-total" value="{{ round(session('total'), 1) }}">
            @else
              <input type="hidden" id="pago-total" value="0">
            @endif
          </div>

          <div class="col m12">
            <p>FORMA DE PAGO</p>

            <p>
              <label>
                <input type="radio" id="deposito" name="forma_pago" value="deposito" checked>
                <span style="font-size: 20px"><i class="fas fa-university"></i> Deposito Bancario</span>
              </label>
            </p>

            <p id="tipo-tarjeta" style="display:none;">
              <label>
                <input type="radio" id="tarjeta" name="forma_pago" value="tarjeta">
                <span style="font-size: 20px"><i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> Pago con Tarjeta</span>
              </label>
            </p>

          </div>

          <div id="div-delivery" class="col m12 margen" style="border:1px dotted">
            <p>DELIVERY</p>

            <p id="texto-delivery">Teniendo en cuenta que su pedido es de Provincia, un asesor de nuestra marca se contactará con usted para coordinar el costo de delivery.</p>
          </div>

          <div class="col m12 right-align margen">
            <span id="mensaje-pedido" style="color:red"></span>

            @if (session('total'))
              @if (session('total') >= 50)

                <button id="pagar" type="submit" class="waves-effect waves-light btn orange">
                  Realizar Compra
                  <i class="fas fa-chevron-right"></i>
                </button>
              @else
                <span style="font-size:18px">El monto minimo para realizar una compra es de S/ 50.00</span>
                <br><br>
                <a href="{{ route('inicio') }}" style="float:right;font-size: 18px;"><i class="fas fa-arrow-left"></i> Ver más productos</a>
              @endif
            @endif
          </div>

        </form>

      </div>
    </div>
  </section>

  <div id="modal-deposito" class="modal modal-facturacion">
    <div class="modal-content">
      @if(isset($cliente->id))
        <h5>Debe realizar su depósito en la siguiente cuenta y enviarnos el voucher desde su lista de pedidos</h5>
      @else
        <h5>Debe realizar su depósito en la siguiente cuenta:</h5>
      @endif
      <p>
        Avantgard Ediciones SAC
        <br>
        <strong>BBVA:</strong> 0011-0234-01-00024902 - Cuenta Corriente
        <br>
        <strong>CCI:</strong> 011- 234-000100024902-27 
      </p>

      @if(!isset($cliente->id))
        <h5>
          Como usuario invitado, debe enviarnos el voucher de depósito al siguiente correo:<br>
          <strong>{{ $configuraciones->email }}</strong>
        </h5>
      @endif
      
    </div>
    <div class="modal-footer">
      <button id="btn-deposito" class="button action-primary action-accept waves-effect waves-light btn orange" type="button">Completar Pedido</button>
    </div>
  </div>

  <div id="modal-tarjeta" class="modal modal-facturacion">
    <div class="modal-content">
      <img src="{{ asset('img/tarjeta.jpg') }}">
      <button id="btn-tarjeta" class="button action-primary action-accept" type="button">Completar Pedido</button>
    </div>
  </div>

  <div id="modal-error" class="modal modal-facturacion">
    <div class="modal-content">
      <p class="error-icon"><i class="fas fa-exclamation-circle"></i></p>
      <p>Debe completar todos los campos obligatorios</p>
    </div>
  </div>

  <div class="loader-facturacion"></div>

@endsection

@section('script')   

  <script src="https://checkout.culqi.com/js/v3"></script>        
            
  <script type="text/javascript">

    var costoElegido = 0;
    var distritoElegido = '';
    var provinciaElegida = '';

    function reiniciarDelivery() {

      costoElegido = 0;
      distritoElegido = '';
      provinciaElegida = '';

      $('#tipo-tarjeta').hide();
      $('#deposito').prop('checked', true);

      $('#texto-delivery').html('Teniendo en cuenta que su pedido es de Provincia, un asesor de nuestra marca se contactará con usted para coordinar el costo de delivery.');
    }

    function culqi() {
      if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        var email = Culqi.token.email;

        var total = $('#pago-total').val();
        var delivery = $('#delivery').val();
        var ciudad = $('#ciudad').val();
        var distrito = $('#distrito').val();
        var direccion = $('#direccion').val();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var telefono = $('#celular').val();
        //var email = $('#email').val();
        
        var parametros = { 
          id:'{{ session()->getId() }}', 
          producto:'Productos varios - TuKrea', 
          total: total, 
          delivery: delivery,
          token: token, 
          address: direccion + ' - ' + distrito,
          address_city: ciudad,
          first_name: nombre,
          last_name: apellidos,
          email: email,
          phone_number: telefono
        };

        $.ajax({
          url: '{{ route("culqi") }}',
          type: 'GET',
          data:  parametros,
          success: function(datos) {
            
            if(datos == 'ok'){
              //enviar formulario pedido
              console.log('pago realizado');
              $('#checkout').submit();
            }
            else {
              console.log(datos);              
              $('#mensaje-pedido').html('No se pudo realizar el pago, intentelo mas tarde...');
              
              setTimeout(function(){
                $('#mensaje-pedido').html('');
              }, 4000);
            }
          },       
          error: function(xhr) {
            console.log('Ocurrio un error.');
          }    
        });


      } 
      else { // ¡Hubo algún problema!
        // Mostramos JSON de objeto error en consola
        console.log(Culqi.error);
        alert(Culqi.error.user_message);
      }
    };


    $(document).ready(function() {

      $('#modal-deposito').modal();
      $('#modal-tarjeta').modal();
      $("#modal-error").modal();

      $('#departamento').change(function(){
        var id = $(this).children(':selected').attr('data-id');

        var parametros = {
          'id' : id
        };

        $.ajax({
          data:  parametros,
          url:   '{{ route("provincias") }}',
          type:  'get',
          beforeSend: function() {
            $('.loader-facturacion').show();
          },
          success:  function(datos) {

            $('#distrito').html('<option value="" disabled selected>Elegir Distrito</option>');

            var provincias = `
              <option value="" disabled selected>Elegir Provincia</option>
            `;

            for(let item of datos) {
              provincias += `<option value="${item.name}" data-id="${item.id}">${item.name}</option>`;
            }

            $('#provincia').html(provincias);
            $('select').formSelect();

            $('.loader-facturacion').hide();
          }
        });
      });

      $('#provincia').change(function(){
        var id = $(this).children(':selected').attr('data-id');

        var parametros = {
          'id' : id
        };

        $.ajax({
          data:  parametros,
          url:   '{{ route("distritos") }}',
          type:  'get',
          beforeSend: function() {
            $('.loader-facturacion').show();
          },
          success:  function(datos) {

            var distritos = `
              <option value="" disabled selected>Elegir Distrito</option>
            `;

            for(let item of datos) {
              distritos += `<option data-costo="${item.costo}" value="${item.name}" data-id="${item.id}">${item.name}</option>`;
            }

            $('#distrito').html(distritos);
            $('select').formSelect();
            $('.loader-facturacion').hide();
          }
        });
      });

      $('#distrito').change(function(){
        distritoElegido = $(this).val();
        costoElegido = $('option:selected', this).attr('data-costo');
        provinciaElegida = ($('#provincia').val()).trim();

        if(provinciaElegida == 'Lima'){

          var total = parseFloat($('#total').val()) + parseFloat(costoElegido);

          var texto = `
            Costo de envío al distrito de ${distritoElegido}: S/. ${costoElegido}<br>

            <h3 style="text-align:left">Total + costo de envío: S/. ${(Math.round(total * 100) / 100).toFixed(2)}</h3>
          `;
          $('#texto-delivery').html(texto);
          $('#tipo-tarjeta').show();

          $('#delivery').val(costoElegido);
        }
        else{
          reiniciarDelivery();
          $('#delivery').val(0);
        }
      });

      $('input:radio[name=boleta_factura]').click(function(){
        var valor = $('input:radio[name=boleta_factura]:checked').val();

        if(valor == 'factura'){
          $('#div-boleta-factura').show('slow');
        }
        else{
          $('#div-boleta-factura').hide('slow');
        }
      });

      $('#pagar').on('click', function(e) {

        e.preventDefault();

        //validar 
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var dni = $('#dni').val();
        var email = $('#email').val();
        var celular = $('#celular').val();
        var departamento = $('#departamento').val();
        var provincia = $('#provincia').val();
        var distrito = $('#distrito').val();
        var direccion = $('#direccion').val();

        console.log('distrito', distrito);

        if(nombre == '' || apellidos == '' || dni == '' || email == '' || celular == '' || departamento == null || provincia == null || distrito == null || direccion == '') {

          $("#modal-error").modal('open');

          return;
        }

        // Abre el formulario con las opciones de Culqi.settings
        //Culqi.open();
        //$.modal.close();
        var formaPago = $("input[name='forma_pago']:checked").val();
        
        if(formaPago == 'deposito'){
          $('#modal-deposito').modal('open');
        }
        else{
          var total = $('#pago-total').val() * 100;
          var delivery = $('#delivery').val() * 100;
          var nuevoTotal = parseFloat(total) + parseFloat(delivery);

          // Configura tu llave pública
          Culqi.publicKey = 'pk_live_5zElyL0tr8Gs35t2';
          // Configura tu Culqi Checkout
          Culqi.settings({
              title: 'TuKrea - Tienda en linea',
              currency: 'PEN',
              description: 'Ralizar pago - productos varios',
              amount: parseFloat(nuevoTotal).toFixed(2)
          });

          setTimeout(function(){ 
            Culqi.open(); 
          }, 600);
        }
      });        

      $('#btn-tarjeta').on('click', function(e) {

        e.preventDefault();
        $('#modal-tarjeta').modal('close');

        var total = $('#pago-total').val() * 100;
        var delivery = $('#delivery').val() * 100;
        var nuevoTotal = parseFloat(total) + parseFloat(delivery);

        // Configura tu llave pública
        Culqi.publicKey = 'pk_live_5zElyL0tr8Gs35t2';
        // Configura tu Culqi Checkout
        Culqi.settings({
            title: 'TuKrea - Tienda en linea',
            currency: 'PEN',
            description: 'Ralizar pago - productos varios',
            amount: parseFloat(nuevoTotal).toFixed(2)
        });

        setTimeout(function(){ 
          Culqi.open(); 
        }, 600);
      }); 

      $('#btn-deposito').on('click', function(e) {

        e.preventDefault();

        console.log('hola');

        $('#checkout').submit();
        
      });  

    });
  </script>     

@endsection