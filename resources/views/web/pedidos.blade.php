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
        <div class="col m12 padding-login">
          <h2>MIS PEDIDOS</h2>

          <table class="shop_table cart" cellspacing="0">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th></th>
                <th>Ver</th>
              </tr>
            </thead>
            <tbody>     
              @foreach($pedidos as $dato)
                <tr>
                  <td>Pedido del dia {{ $dato->created_at->format('d/m/Y') }}</td>
                  <td>S/. {{ $dato->total }}</td>
                  <td>{{ $dato->tipo }}</td>
                  <td>{{ $dato->estado }}</td>


                  @if($dato->tipo == 'deposito' && $dato->estado == 'Pendiente de pago')
                    <td style="text-align:center;">
                      <a href="{{ route('clientes.pedido', $dato->id) }}" class="ver-detalle" title="Subir Voucher">
                        <i class="fas fa-file-upload"></i>
                      </a>
                    </td>
                  @else
                    <td></td>
                  @endif

                  <td style="text-align:center;">
                    <a href="{{ route('clientes.pedido', $dato->id) }}" class="ver-detalle" title="Ver Detalle">
                      <i class="fas fa-eye"></i>
                    </a>
                  </td>
                </tr>
              @endforeach 
            </tbody>
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