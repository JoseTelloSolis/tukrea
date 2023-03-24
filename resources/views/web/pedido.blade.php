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

  <section class="content first mi-carrito mi-pedido">
    <div class='container'>   
      <div class="row">
        <div class="col m12 padding-login">

          <a href="{{ route('clientes.pedidos') }}" class="boton-volver"><i class="fas fa-reply"></i> Volver</a>
          
          <h2>PEDIDO DEL DIA {{ $datosPedido->created_at->format('d/m/Y') }}</h2>

          <hr>

          @if($datosPedido->tipo == 'deposito')
            <h3>Tipo: Deposito bancario</h3>
          @else
            <h3>Tipo: Pago con tarjeta</h3>
          @endif

          <h3>Estado: {{ $datosPedido->estado }}</h3>

          @if($datosPedido->tipo == 'deposito' && $datosPedido->estado == 'Pendiente de pago')
            <form class="form-voucher" method="POST" action="{{ route('clientes.pedido', $datosPedido->id) }}" enctype="multipart/form-data">

              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="row">
                <div class="col s12">
                  <h4>Subir voucher:</h4>
                </div>
              </div>

              <div class="row">
                <div class="col s8">
                  <div class="file-field input-field">
                    <div class="btn">
                      <span>Seleccionar voucher</span>
                      <input type="file" name="imagen" id="imagen">
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text">
                    </div>
                  </div>
                </div>

                <div class="col s4">
                  <div class="file-field input-field">
                    <button type="submit" class="waves-effect waves-light btn orange boton-full"><i class="fas fa-file-upload"></i> Subir</button>
                  </div>
                </div>
              </div>
              
            </form>          
          @elseif($datosPedido->tipo == 'deposito' && $datosPedido->estado == 'Pendiente de confirmacion')
            <a href="{{ asset($datosPedido->voucher) }}" class="ver-voucher" target="_blank"><i class="fas fa-eye"></i> Ver voucher</a>
          @else

          @endif

          <table class="shop_table cart" cellspacing="0">
            <thead>
              <tr>
                <th class="product-name">Producto</th>
                <th class="product-quantity">Cantidad</th>
                <th class="product-total">Total</th>
              </tr>
            </thead>            

            <tbody>
              @foreach($datosDetalle as $dato)
                <tr class="checkout_table_item">
                  <td class="product-name">{{ $dato->nombre }}
                    <dl class="variation">
                      <dt>Código: {{ $dato->codigo }}</dt>
                    </dl>
                  </td>
                  <td class="product-quantity">{{ $dato->cantidad }}</td>
                  <td class="product-total">
                    <span class="monto">
                      <strong>S/. {{ $dato->precio_t }}</strong>
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>

            <tfoot>
              <tr class="total">
                <td colspan="2" class="m3"><strong>Total</strong></td>
                <td><span class="monto"><strong>S/. {{ $datosPedido->total }}</strong></span></td>
              </tr>
            </tfoot>

          </table>

        </div>

      </div>
    </div>
  </section>

@endsection

@section('script')        
            
  <script type="text/javascript">

    $(document).ready(function() {

      

    });
  </script>     

@endsection