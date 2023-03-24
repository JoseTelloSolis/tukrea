<div id="sidebar">

  @if (isset($templateFiltros))
    <div id="sidebarx" class="sidebar-padding widget_product_categories">
      <h2>
        ORDENAR POR
      </h2>
      <ul class="product-categories">
        <li class="cat-item cat-item-7">
          <a href="javascript:void(0)" id="ordenar-precio-menor">Precio (de menor a mayor)</a>
        </li>
        <li class="cat-item cat-item-7">
          <a href="javascript:void(0)" id="ordenar-precio-mayor">Precio (de mayor a menor)</a>
        </li>
        <li class="cat-item cat-item-7">
          <a href="javascript:void(0)" id="ordenar-a-z">A-Z (alfabéticamente)</a>
        </li>
        <li class="cat-item cat-item-7">
          <a href="javascript:void(0)" id="ordenar-z-a">Z-A (alfabéticamente)</a>
        </li>
      </ul>
    </div>

    <div id="sidebarx" class="sidebar-padding widget_product_categories">
      <h2>
        FILTROS
      </h2>
      <div class="div-precios">
        <p>Precio: S/. <span id="texto-precios">0 - 999</span></p>
        <div id="slider-range"></div>
        <input type="hidden" id="rango-minimo" value="0">
        <input type="hidden" id="rango-maximo" value="999">
      </div>

      <div class="div-boton-filtro">
        <button id="aplicar-filtros" class="boton-filtro">Aplicar Filtros</button>
      </div>
    </div>
  @endif

  <div id="sidebarx" class="sidebar-padding widget_product_categories">
    <h2>
      CATEGORIAS
    </h2>
    <ul class="product-categories">
      @foreach($categorias as $categoria)
      <li class="cat-item cat-item-7">
        <a href="{{ route('categorias', $categoria->url) }}"><span class="categoria-sidebar">{{ $categoria->nombre }}</span> <span class="flecha2"></span></a>
      </li>
      @endforeach
    </ul>
  </div>

  <div id="sidebary" class="sidebar-padding widget_top_rated_products">
    <h2>
      PRODUCTOS DESTACADOS
    </h2>
    <ul class="product_list_widget">
      @foreach($destacados as $producto)
      <li>
        <a href="{{ route('producto', $producto->url) }}" title="{{ $producto->nombre }}">
          <img width="90" height="56" src="{{ asset($producto->imagen) }}" class="attachment-shop_thumbnail wp-post-image" alt="" title="" /> 
          {{ $producto->nombre }}
        </a>
        
        <p>{!! $producto->resumen !!}</p>
        <span class="margin-top: -32px;">
          S/. {{ $producto->precio }}
        </span>
      </li>
      @endforeach
    </ul>
  </div>
</div>