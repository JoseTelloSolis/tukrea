<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;
use DB;
use Hash;
use Carbon\Carbon;

// Cargamos Requests y Culqi PHP
use Culqi\Culqi;
use Culqi\CulqiException;

use GuzzleHttp\Client;

class WebController extends Controller {

	public function getToken(){     
	  
		$client = new Client();

		$response = $client->request(
			'POST',
	    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/login/GetLogin',
	    [
        'json' => [
					"NomUsuario" => "",
					"PwdUsuario" => " ",
					"Email" => "prueba@navasoft.com.pe",
					"Pwd_Email" => "1001"
        ]
	    ]
		);

		$data = json_decode($response->getBody()->getContents(), true);
		$token = $data['data']['token'];

		return $token;
	}
  
  //----------------------------------------------------------------------
	//inicio
	public function inicio() {

		$configuraciones = App\Configuraciones::findOrFail(1);

		$blog = App\Blog::select()
		->orderBy('id', 'desc')
		->limit(3)
		->get();

		$datos = App\Portada::findOrFail(1);

		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		$niveles = App\Niveles::firstOrFail()
		->where('id', 1)
		->first();

		$productosNiveles = App\Productos::firstOrFail()
		->where('activo', 1)
		->where('imagen', '<>', '')
		->where('niveles', 'like', '%1%')
		->get();

		$productos = App\Productos::firstOrFail()
		->where('activo', 1)
		->where('imagen', '<>', '')
		->limit(6)
		->get();

		return view('web.inicio', compact(['configuraciones', 'datos', 'categorias', 'productos', 'blog', 'niveles', 'productosNiveles']));
	}

	//----------------------------------------------------------------------
	//filosofia
	public function filosofia() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$portada = App\Portada::findOrFail(1);

		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		$datos = App\Filosofia::findOrFail(1);
		$entradas = App\FilosofiaEntradas::select()->get();	

		return view('web.filosofia', compact(['datos', 'entradas', 'configuraciones', 'categorias', 'portada']));
	}

	//----------------------------------------------------------------------
	//blog
	public function blog() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$portada = App\Portada::findOrFail(1);

		$blog = App\Blog::select()
		->orderBy('id', 'desc')
		->paginate(12);

		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		return view('web.blog', compact(['configuraciones', 'categorias', 'blog', 'portada']));
	}

	public function blogDetalle($url) {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$portada = App\Portada::findOrFail(1);

		$datos = App\Blog::select()
		->where('url', $url)
		->first();

		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		return view('web.blogdetalle', compact(['configuraciones', 'categorias', 'datos', 'portada']));
	}

	//----------------------------------------------------------------------
	//nosotros
	public function nosotros() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		$datos = App\Nosotros::findOrFail(1);

		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.nosotros', compact(['categorias', 'datos', 'destacados', 'configuraciones']));
	}

	//----------------------------------------------------------------------
	//politicas
	public function politicas() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		$datos = App\Politicas::findOrFail(1);
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.politicas', compact(['categorias', 'datos', 'destacados', 'configuraciones']));
	}

	//----------------------------------------------------------------------
	//contacto
	public function contacto() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$datos = App\Contacto::findOrFail(1);

		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.contacto', compact(['datos','categorias', 'destacados', 'configuraciones', 'configuraciones']));
	}

	public function contactoEnviar(Request $request) {
		$configuraciones = App\Configuraciones::findOrFail(1);

		$mensaje = '
			Nombre: '. $request->nombre .'<br>
			Telefono: '. $request->telefono .'<br>
			Email: '. $request->email .'<br><br>
			Mensaje: '. $request->mensaje .'<br>
		';

		//enviarEmail($para, $email, $titulo, $mensaje)
		$enviar = $this->enviarEmail($configuraciones->email, $request->email, 'TuKrea - contacto web', $mensaje);

		if($enviar == 1) {
			return back()->with('mensaje', 'Su mensaje ha sido enviado. En breve le responderemos.');
		}
		
	}

	//----------------------------------------------------------------------
	//categorias
	public function categorias($url) {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		$datosCategoria = App\Categorias::firstOrFail()->where('url', $url)->first();
		$datosSubfamilias = App\Subfamilias::select()->where('id_categoria', $datosCategoria->id)->where('activo', 1)->get();

		$datosProductos = App\Productos::select()
		->where('activo', 1)
		->where('en_grupo', 0)
		->where('imagen', '<>', '')
		->where(\DB::raw('substr(idcodi, 1, 2)'), '=' , $datosCategoria->codigo)
		->get();

		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		$templateFiltros = true;

		return view('web.categoria', compact(['categorias', 'datosCategoria', 'datosSubfamilias', 'datosProductos', 'destacados', 'configuraciones', 'templateFiltros']));
	}

	//----------------------------------------------------------------------
	//productos
	public function productos() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		$portada = App\Portada::findOrFail(1);

		$productos = App\Productos::select()
		->where('activo', 1)
		->where('imagen', '<>', '')
		->get();

		$niveles = App\Niveles::firstOrFail()->OrderBy('orden', 'asc')->get();

		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.productos', compact(['categorias', 'productos', 'destacados', 'portada', 'configuraciones', 'niveles']));
	}

	public function categoria($url) {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		$portada = App\Portada::findOrFail(1);

		$datosCategoria = App\Categorias::firstOrFail()->where('url', $url)->first();

		$productos = App\Productos::selectRaw('*, (SELECT b.orden FROM grados b WHERE id_grado = b.id) as orden')
		->where('id_categoria', $datosCategoria->id)
		->where('activo', 1)
		->where('imagen', '<>', '')
		->get();

		$planLector = App\Productos::selectRaw('*, (SELECT b.orden FROM grados b WHERE id_grado = b.id) as orden')
		->where('id_categoria', 4)
		->where('activo', 1)
		->where('imagen', '<>', '')
		->get();

		$niveles = App\Niveles::firstOrFail()->OrderBy('orden', 'asc')->get();

		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.categoria', compact(['datosCategoria','categorias', 'productos', 'planLector', 'destacados', 'portada', 'configuraciones', 'niveles']));
	}

	//----------------------------------------------------------------------
	//producto
	public function producto($url) {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		$datos = App\Productos::firstOrFail()->where('url', $url)->first();
		$imagenes = App\ProductosImagenes::select()->where('id_producto', $datos->id)->get();

		$colores = [];
		$tallas = [];
		$variantes = [];

		if($datos->colores != '') {
			$colores = json_decode($datos->colores);
		}

		if($datos->tallas != '') {
			$tallas = json_decode($datos->tallas);
		}

		if($datos->ids_productos != '') {
			$arrayIds = explode(',', $datos->ids_productos);

			$variantes = App\Productos::select()
			->whereIn('id', $arrayIds)
			->get();
		}
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.producto', compact(['categorias', 'datos', 'imagenes', 'destacados', 'configuraciones', 'colores', 'tallas', 'variantes']));
	}

	//----------------------------------------------------------------------
	//buscar
	public function buscar(Request $request) {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		$portada = App\Portada::findOrFail(1);

		$niveles = App\Niveles::firstOrFail()->OrderBy('orden', 'asc')->get();

		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		$productos = App\Productos::select()
		->where('activo', true)
		->where('nombre', 'like', '%'. $request->buscar . '%')
		->get();

		return view('web.buscar', compact(['categorias', 'productos', 'destacados', 'portada', 'configuraciones', 'niveles']));
	}

	//----------------------------------------------------------------------
	//carrito
	public function carrito() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		return view('web.carrito', compact(['categorias', 'configuraciones']));

	}

	public function carritoAdd(Request $request) {

		$id_item = $request->idx;
    $cantidad = isset($request->quantity) ? $request->quantity : 1;
    $detalle = array('cantidad' => $cantidad);
    $producto = App\Productos::findOrFail($id_item);

    $activarTallas = $request->activar_tallas;
    $activarColores = $request->activar_colores;

    $nombreProducto = $producto->nombre;

    if($activarColores == 1) {
    	$nombreProducto = $nombreProducto . ' - ' . $request->color;
    }

    if($activarTallas == 1) {
    	$nombreProducto = $nombreProducto . ' - talla ' . $request->talla;
    }

    $detalle['id'] = $producto->id;
    $detalle['url'] = $producto->url;
    $detalle['nombre'] = $nombreProducto;
    $detalle['imagen'] = $producto->imagen;
    $detalle['codigo'] = $producto->codigo;
    $detalle['precio_u'] = number_format($producto->precio, 2, '.', '');
    $detalle['precio_t'] = number_format(($detalle['cantidad'] * $detalle['precio_u']), 2, '.', '');

    $prod_md5 = md5($detalle['nombre'] . $detalle['id']);
    $detalle['codigo_md5'] = $prod_md5;

		if(session('carrito.' . $prod_md5)) {

			$acumularCantidad = session('carrito.' . $prod_md5 . '.cantidad') + $cantidad;
			$request->session()->put('carrito.' . $prod_md5 . '.cantidad', $acumularCantidad);

      $newCantidad = session('carrito.' . $prod_md5 . '.cantidad');

      $acumularTotal = session('carrito.' . $prod_md5 . '.precio_u') * $newCantidad;
      $request->session()->put('carrito.' . $prod_md5 . '.precio_t', $acumularTotal);

      /* Actualizar el total del carrito */
      $total = 0;
      foreach(session('carrito') as $key => $value) {
        $total += $value['precio_t'];
      }

      $request->session()->put('total', number_format($total, 2, '.', ''));
    } 
    else {
    	$request->session()->put('carrito.' . $prod_md5, $detalle);
      $request->session()->put('carrito.' . $prod_md5 . '.total', 0);

      /* Actualizar el total del carrito */
      $total = 0;
      foreach (session('carrito')  as $key => $value) {
        $total += $value['precio_t'];
      }

      $request->session()->put('total', number_format($total, 2, '.', ''));
    }

    //$categorias = App\Categorias::firstOrFail()->where('activo', 1)->get();
    //return redirect()->route('carrito')->with(compact(['categorias']));
    return 'ok';
	}

	public function carritoDelete(Request $request) {

		$codigo = $request->codigo;
    $request->session()->forget('carrito.'.$codigo);

    /* Actualizar el total del carrito */
    $total = 0;
    foreach(session('carrito') as $key => $value) {
      $total += $value['precio_t'];
    }

    $request->session()->put('total', number_format($total, 2, '.', ''));

    return 'ok';
	}

	public function carritoUpdate(Request $request) {

		$codigo = $request->codigo;
    $cantidad = $request->cantidad;

    /* Actualizar la cantidad del item */
    $request->session()->put('carrito.' . $codigo . '.cantidad', $cantidad);

    $acumularTotal = session('carrito.' . $codigo . '.precio_u') * $cantidad;
    $request->session()->put('carrito.' . $codigo . '.precio_t', number_format($acumularTotal, 2, '.', ''));

    /* Actualizar el total del carrito */
    $total = 0;
    foreach (session('carrito')  as $key => $value) {
      $total += $value['precio_t'];
    }

    $request->session()->put('total', number_format($total, 2, '.', ''));

    return 'ok';
	}

	public function getCarrito() {

		$datos = '';

		if(session('carrito') == null) {
			return '';
		}

		foreach(session('carrito') as $key => $value) {
			$datos .= '
				<li class="item product product-item" data-role="product-item">
	        <div class="product">
	          <div class="product-item-photo">
	            <a class="item-photo" href="'.route('producto', $value['url']).'" title="'.$value['nombre'].'">
	              <span class="product-image-container">
	                <span class="product-image-wrapper">
	                  <img class="product-image-photo" src="'.asset($value['imagen']).'" alt="'.$value['nombre'].'">
	                </span>
	              </span>
	            </a>
	            
	            <div class="product-actions">
	              <div class="primary">
	                <a class="action edit" href="'.route('producto', $value['url']).'" title="Ver Producto">
	                  <i class="fas fa-eye"></i>
	                </a>
	              </div>
	              <div class="secondary">
	                <a href="#" data-codigo="'.$value['codigo_md5'].'" class="action carrito-delete" title="Eliminar Producto">
	                  <i class="fas fa-times"></i>
	                </a>
	              </div>
	            </div>
	          </div>
	      
	          <div class="product-item-details">
	            <strong class="product-item-name">
	              <a href="'.route('producto', $value['url']).'">'.$value['nombre'].'</a>
	            </strong>

	            <div class="product-item-pricing">
	              <div class="price-container">
	                <span class="price-wrapper">
	                  <span class="price-excluding-tax">
	                    <span class="minicart-price">
	                      Precio Unidad<br>
	                      <span class="price">S/ '.$value['precio_u'].'</span>        
	                    </span>
	                  </span>
	                </span>
	              </div>

	              <div class="details-qty qty">
	                <input type="number" size="4" class="carrito-cantidad item-qty cart-item-qty" data-codigo="'.$value['codigo_md5'].'" value="'.$value['cantidad'].'" min="1">
	                <div class="cantidad-readonly"></div>
	              </div>
	            </div>

	            <div class="clear"></div>
	          </div>

	          <div class="clear"></div>
	        </div>
	      </li>
			';
    }

		return $datos;
	}

	public function getCarritoTabla(Request $request) {

		//$request->session()->flush();

		$datos = '';

		if(session('carrito') == null) {
			return '';
		}

		foreach(session('carrito') as $key => $value) {
			$datos .= '
	      <tr class="cart_table_item" id="'.$value['id'].'">
          <td class="product-name">
            <a href="'.route('producto', $value['url']).'">'.$value['nombre'].'</a>
            <dl class="variation">
              <dt>Código: '.$value['codigo'].'</dt>
            </dl>
          </td>
          <td class="product-quantity quantity buttons_added div-cantidad">
	          <div class="number-input">
              <button type="button" onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown()" ></button>
              <input type="number" min="1" value="'.$value['cantidad'].'" size="4" class="input-text qty text noradius carrito-tabla-cantidad browser-default" data-codigo="'.$value['codigo_md5'].'" maxlength="12">
              <button type="button" onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp()" class="plus"></button>
            </div>
          </td>
          <td class="product-price">
            <span class="amount" data-real="'.$value['precio_u'].'">S/. '.$value['precio_t'].'</span>
          </td>
          <td class="div-tabla-eliminar">
            <a href="#" data-codigo="'.$value['codigo_md5'].'" class="carrito-tabla-delete"><i class="fas fa-times"></i></a>
          </td>
        </tr>
			';
    }

		return $datos;
	}

	public function getCarritoTotal() {

		return session('total');
	}

	public function getCarritoConteo() {

		$conteo = 0;

		if(session('carrito') == null) {
			return 0;
		}

		foreach(session('carrito') as $key => $value) {
			$conteo++;
    }

		return $conteo;
	}

	//----------------------------------------------------------------------
	//clientes
	public function login() {

		if(Auth::guard('clientes')->check()) {
      if(session('carrito')) {
    		//si el carrito tiene productos
    		return redirect()->route('facturacion');
    	}
    	else {
    		//si el carrito esta vacio
    		return redirect()->route('clientes.perfil');
    	}
    }

    $configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		return view('web.login', compact(['categorias', 'configuraciones']));

	}

	public function postLogin(Request $request) {

    $email = $request->input('email');
    $password = $request->input('password');

    if(Auth::guard('clientes')->attempt(['email' => $email, 'password' => $password])) {
    	if(session('carrito')) {
    		//si el carrito tiene productos
    		return redirect()->route('facturacion');
    	}
    	else {
    		//si el carrito esta vacio
    		return redirect()->route('inicio');
    	}
    }

    return back()->with('mensajeLogin', 'Email o contraseña incorrectos');

	}

	public function enviarEmail($para, $email, $titulo, $mensaje, $email_copia = ''){
		try{

			// Para enviar un correo HTML, debe establecerse la cabecera Content-type
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Cabeceras adicionales
			$cabeceras .= "To: $para" . "\r\n";
			$cabeceras .= "From: <$email>" . "\r\n";

			if($email_copia != ''){				
				$cabeceras .= "Cc: $email_copia" . "\r\n";
				//$cabeceras .= "Bcc: $email_copia" . "\r\n";
			}

			$titulo = utf8_decode($titulo);

			// Enviarlo
			if(mail($para, $titulo, $mensaje, $cabeceras)){
				return 1;
			}
			else{
				return 0;
			}
		}
		catch(Exception $error){
			return $error->getMessage();
		}
	}

	public function postRegistro(Request $request) {

		//checkar si el usuario ya existe
		if(App\Clientes::where('email', $request->email)->first()){
			//si ya existe devolver mensaje
  		return back()->with('mensaje', 'El correo ya se encuentra registrado');
    }
    else {
    	//si no existe crear
    	$nuevoCliente = new App\Clientes;
			$nuevoCliente->email = $request->email;
			$nuevoCliente->nombre = $request->nombre;
			$nuevoCliente->apellidos = $request->apellidos;
			$nuevoCliente->password = bcrypt($request->password);

			$nuevoCliente->dni = '';
			$nuevoCliente->ruc = '';
			$nuevoCliente->razon_social = '';
			$nuevoCliente->telefono = '';
			$nuevoCliente->celular = '';
			$nuevoCliente->ciudad = '';
			$nuevoCliente->distrito = '';
			$nuevoCliente->direccion = '';

			$nuevoCliente->save();

			//login con el nuevo usuario
			Auth::guard('clientes')->login($nuevoCliente);

			//enviar email
			$configuraciones = App\Configuraciones::findOrFail(1);
			$enviar = $this->enviarEmail($request->email, $configuraciones->email, 'TuKrea - Su cuenta ha sido creada', $configuraciones->email_registro);

			if(session('carrito')) {
    		//si el carrito tiene productos
    		return redirect()->route('facturacion');
    	}
    	else {
    		//si el carrito esta vacio
    		return redirect()->route('inicio');
    	}
    }
		
	}

	public function postPerfil(Request $request) {

		$email = Auth::guard('clientes')->user()->email;

		$cliente = App\Clientes::firstOrFail()->where('email', $email)->first();

		if($cliente){
			//si encuentra los datos del cliente
			//$cliente->email = $request->email;
			$cliente->nombre = $request->nombre == null ? '' : $request->nombre;
			$cliente->apellidos = $request->apellidos == null ? '' : $request->apellidos;
			$cliente->dni = $request->dni == null ? '' : $request->dni;

			$cliente->ruc = $request->ruc == null ? '' : $request->ruc;
			$cliente->razon_social = $request->razon_social == null ? '' : $request->razon_social;
			$cliente->telefono = $request->telefono == null ? '' : $request->telefono;
			$cliente->celular = $request->celular == null ? '' : $request->celular;
			$cliente->ciudad = $request->ciudad == null ? '' : $request->ciudad;
			$cliente->distrito = $request->distrito == null ? '' : $request->distrito;
			$cliente->direccion = $request->direccion == null ? '' : $request->direccion;

			$cliente->save();
  		return back()->with('mensajePerfilOk', 'Sus datos han sido actualizados');
    }
    else {
    	//si no encuentra enviar mensaje de error
    	return back()->with('mensajePerfil', 'Ocurrió un error, intentelo mas tarde...');
    }
		
	}

	public function cambiarPassword(Request $request) {

		$email = Auth::guard('clientes')->user()->email;

		$cliente = App\Clientes::firstOrFail()->where('email', $email)->first();

		if(Hash::check($request->password, $cliente->password)) {
			//si el password original es correcto
			$cliente->password = bcrypt($request->newPassword);
			$cliente->save();

			return back()->with('mensajePasswordOk', 'La contraseña ha sido actualizada');
		}
		else {
			//si el password es incorrecto
			return back()->with('mensajePassword', 'La contraseña actual es incorrecta');
		}
		
	}

	public function passwordReset() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		return view('web.passwordemail', compact(['categorias', 'configuraciones']));
	}

	public function putPasswordReset(Request $request) {
		$datosCliente = App\Clientes::select()->where('email', $request->email)->first();

		//verificar si el usuario existe
		if(count($datosCliente) < 1) {
	    return back()->with('mensajeError', 'El correo ingresado no esta registrado en nuestro sistema...');
		}

		//crear el token
		$password = new App\PasswordResets;
		$password->email = $request->email;
		$password->token = str_random(60);
		$password->created_at = Carbon::now();
		$password->save();

		//recuperar el token creado
		$datosToken = App\PasswordResets::select()->where('email', $request->email)->first();

		if($this->sendResetEmail($request->email, $datosToken->token)) {
			return back()->with('mensaje', 'Un enlace ha sido enviado a su correo. No olvide revisar su bandeja de spam');
		} 
		else {
			return back()->with('mensajeError', 'Ah ocurrido un error. Intentelo mas tarde...');
		}
  }

  private function sendResetEmail($email, $token){
		//obtener los datos del cliente del email recibido
		$datosCliente = App\Clientes::select()->where('email', $email)->first();
		//Generar el password reset link
		$link = route('cliente.resetPassword', compact('token', 'email'));

    try {
    	//enviar email 
    	//enviarEmail($para, $email, $titulo, $mensaje)
    	$configuraciones = App\Configuraciones::findOrFail(1);

    	$mensaje = 'Hola, ' . $datosCliente->nombre . ' ' . $datosCliente->apellidos . '<br>
    		Recibimos la solicitud de nueva contrase&ntilde;a para su cuenta en la web "TuKrea".<br>
    		<br>
				Para restablecer su contrase&ntilde;a dir&iacute;jase a la siguiente direcci&oacute;n:<br><br>
				<a href="' . $link . '" target="_blank">Restablecer contrase&ntilde;a</a><br><br>
				Si no solicit&oacute; un restablecimiento de contrase&ntilde;a, ignore este mensaje.
			';

    	$enviar = $this->enviarEmail($email, $configuraciones->email, 'TuKrea - Restablecer contraseña', $mensaje);
      return true;
    } 
    catch (\Exception $e) {
      return false;
    }
	}

	public function resetPassword() {
		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		return view('web.passwordreset', compact(['categorias', 'configuraciones']));
	}

	public function putResetPassword(Request $request) {

		// validar el token
		$tokenData = App\PasswordResets::select()->where('token', $request->token)->first();

		// regresa con mensaje de error si el token es invalido
		if(!$tokenData) {
			return back()->with('mensajeError', 'El token es invalido o ha caducado...');
		}

		$cliente = App\Clientes::select()->where('email', $tokenData->email)->first();

		// regresa si el email es invalido
		if(!$cliente){
			return back()->with('mensajeError', 'El email es incorrecto...');
		}

		// actualizar el password
		$cliente->password = bcrypt($request->password);
		$cliente->save(); //or $user->save();

		//eliminar el token
		App\PasswordResets::select()->where('email', $cliente->email)->delete();

		return back()->with('mensaje', 'Su contraseña ha sido actualizada. Ingrese con su nueva contraseña.');
	}

	public function perfil() {

		if(!Auth::guard('clientes')->check()) {
      return redirect()->route('clientes.login');
    }

    $configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		$email = Auth::guard('clientes')->user()->email;
		$cliente = App\Clientes::firstOrFail()->where('email', $email)->first();

		return view('web.perfil', compact(['categorias', 'cliente', 'configuraciones']));
	}

	public function logout(Request $request) {

    Auth::guard('clientes')->logout();
  	return redirect()->route('inicio');
	}

	//----------------------------------------------------------------------
	//facturacion
	public function facturacion() {

		$cliente = [];

		if(Auth::guard('clientes')->check()) {
      $email = Auth::guard('clientes')->user()->email;
			$cliente = App\Clientes::firstOrFail()->where('email', $email)->first();
    }

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();

		$departamentos = DB::table('ubigeo_peru_departments')->get();

		return view('web.facturacion', compact(['categorias', 'cliente', 'configuraciones', 'departamentos']));
	}

	public function pagoCulqi(Request $request) {

		//register_autoloader();

    $SECRET_KEY = 'sk_live_HZV25tU1rRyRIyQj';
		$culqi = new Culqi(array('api_key' => $SECRET_KEY));

		$charge = $culqi->Charges->create(
	    array(
	      "amount" => $request->total + $request->delivery,
	      "capture" => true,
	      "currency_code" => "PEN",
	      "description" => $request->producto,
	      "email" => $request->email,
	      "installments" => 0,
	      "antifraud_details" => array(
	          "address" => $request->address,
	          "address_city" => $request->address_city,
	          "country_code" => "PE",
	          "first_name" => $request->first_name,
	          "last_name" => $request->last_name,
	          "phone_number" => $request->phone_number,
	      ),
	      "source_id" => $request->token
	    )
		);

		return 'ok';
	}

	public function crearPedido(Request $request) {

		//guardar pedido
		$pedido = new App\Pedidos;
		$pedido->id_cliente = $request->cliente == null ? '' : $request->cliente;
		$pedido->nombre = $request->nombre == null ? '' : $request->nombre;
		$pedido->apellidos = $request->apellidos == null ? '' : $request->apellidos;
		$pedido->dni = $request->dni == null ? '' : $request->dni;
		$pedido->email = $request->email == null ? '' : $request->email;
		$pedido->telefono = $request->telefono == null ? '' : $request->telefono;
		$pedido->celular = $request->celular == null ? '' : $request->celular;

		$pedido->departamento = $request->departamento == null ? '' : $request->departamento;
		$pedido->provincia = $request->provincia == null ? '' : $request->provincia;
		$pedido->distrito = $request->distrito == null ? '' : $request->distrito;
		
		$pedido->direccion = $request->direccion == null ? '' : $request->direccion;
		$pedido->total = session('total');
		$pedido->delivery = $request->delivery;
		$pedido->tipo = $request->forma_pago;
		$pedido->voucher = '';

		$pedido->boleta_factura = $request->boleta_factura == null ? '' : $request->boleta_factura;

		if($request->boleta_factura == 'factura') {
			$pedido->ruc = $request->ruc == null ? '' : $request->ruc;
			$pedido->razon_social = $request->razon_social == null ? '' : $request->razon_social;
		}
		else {
			$pedido->ruc = '';
			$pedido->razon_social = '';
		}

		if($request->forma_pago == 'deposito'){
			$pedido->estado = 'Pendiente de pago';
		}
		else{
			$pedido->estado = 'Pagado - Pendiente de entrega';
		}		

		$pedido->save();

		//guardar detalle de pedido en la session
		foreach (session('carrito')  as $key => $value) {

			$detalle = new App\DetallePedidos;
			$detalle->id_pedido = $pedido->id;
			$detalle->codigo = $value['codigo'];
			$detalle->nombre = $value['nombre'];
			$detalle->cantidad = $value['cantidad'];
			$detalle->precio_t = $value['precio_t'];

			$detalle->save();
    }

		//enviar correos
		$configuraciones = App\Configuraciones::findOrFail(1);

		if($request->forma_pago == 'deposito'){
			//enviar correo deposito
			//concatenar detalle de la compra
			$enviarMensaje = $configuraciones->email_compra_deposito;

			$mensajeParaAdmin = '
				<h3>Pedido realizado - en espera del pago</h3>
			';

			if($request->cliente == 0) {
				$mensajeParaAdmin .= '
					<h4>Compra realizada como <strong>invitado</strong></h4>
				';
			}
			else {
				$mensajeParaAdmin .= '
					<h4>Compra realizada con <strong>cuenta creada</strong></h4>
				';
			}			

			$mensajeParaAdmin .= '
				<p>
					Tipo de pago: Deposito Bancario<br><br>
					Nombre: ' . $request->nombre . ' ' . $request->apellidos . '<br>
					Dni: ' . $request->dni . '<br><br>
					Email: ' . $request->email . '<br>
					Telefono Fijo: ' . $request->telefono . '<br>
					Celular: ' . $request->celular . '<br><br>
					Departamento: ' . $request->departamento . '<br>
					Ciudad: ' . $request->provincia . '<br>
					Distrito: ' . $request->distrito . '<br>					
					Direccion: ' . $request->direccion . '<br>
				</p>
			';

			if($request->boleta_factura == 'factura') {
				$mensajeParaAdmin .= '
					<p>
						Comprobante de pago: Factura<br>
						Ruc: ' . $request->ruc . '<br>
						Razon Social: ' . $request->razon_social . '<br>
					</p>
				';
			}
			else {
				$mensajeParaAdmin .= '
					<p>
						Comprobante de pago: Boleta
					</p>
				';
			}

			$mensajeHTML = '

				<style>
					table {
						width: 100%;
						max-width: 850px;
						border-collapse: collapse;
					}
					table th {
						font-weight: bold;
					}
					th, td {
					  border: 1px solid #000000;
					}
				</style>

				<table>
          <thead>
            <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Total</th>
            </tr>
          </thead>
          
          <tbody>
		  ';

		  foreach (session('carrito')  as $key => $value) {

		  	$mensajeHTML .= '
	            
          <tr>
            <td class="product-text">
            	' . $value['nombre'] . '
            	<br>
            	Codigo: ' . $value['codigo'] . '
            </td>
            <td class="product-text">
            	' . $value['cantidad'] . '
            </td>
            <td class="product-text">
              S/. ' . $value['precio_t'] . '
            </td>
          </tr>
		  	';
	    }
		             
		  $mensajeHTML .= '
          </tbody>

        	<tfoot>
            <tr class="total">
              <th colspan="2"><strong>Subtotal</strong></th>
              <td><strong>S/. '.session('total').'</strong></td>
            </tr>
            <tr class="total">
              <th colspan="2"><strong>Costo de envio</strong></th>
              <td><strong>S/. '.$request->delivery.'</strong></td>
            </tr>
            <tr class="total">
              <th colspan="2"><strong>Total</strong></th>
              <td><strong>S/. '.(session('total') + $request->delivery).'</strong></td>
            </tr>
          </tfoot>
        </table>
			';

			$enviarMensaje = $enviarMensaje . '<br>' . $mensajeHTML;
			$mensajeParaAdmin = $mensajeParaAdmin . '<br>' . $mensajeHTML;

			$enviar = $this->enviarEmail($request->email, $configuraciones->email, 'TuKrea - Su pedido ha sido generado', $enviarMensaje);

			$enviarAdmin = $this->enviarEmail($configuraciones->email, $request->email, 'TuKrea - Pedido generado', $mensajeParaAdmin, $configuraciones->email_copia);
		}
		else{
			//enviar correo compra con tarjeta
			//para, de, titulo, mensaje
			//concatenar detalle de la compra
			$enviarMensaje = $configuraciones->email_compra;

			$mensajeParaAdmin = '
				<h3>Pedido realizado - pago realizado con tarjeta</h3>
			';

			if($request->cliente == 0) {
				$mensajeParaAdmin .= '
					<h4>Pedido realizado como <strong>invitado</strong></h4>
				';
			}
			else {
				$mensajeParaAdmin .= '
					<h4>Pedido realizado con <strong>cuenta creada</strong></h4>
				';
			}

			$mensajeParaAdmin .= '
				<p>
					Tipo de pago: Tarjeta<br><br>
					Nombre: ' . $request->nombre . ' ' . $request->apellidos . '<br>
					Dni: ' . $request->dni . '<br><br>
					Email: ' . $request->email . '<br>
					Telefono Fijo: ' . $request->telefono . '<br>
					Celular: ' . $request->celular . '<br><br>
					Departamento: ' . $request->departamento . '<br>
					Ciudad: ' . $request->provincia . '<br>
					Distrito: ' . $request->distrito . '<br>					
					Direccion: ' . $request->direccion . '<br>
				</p>
			';

			if($request->boleta_factura == 'factura') {
				$mensajeParaAdmin .= '
					<p>
						Comprobante de pago: Factura<br>
						Ruc: ' . $request->ruc . '<br>
						Razon Social: ' . $request->razon_social . '<br>
					</p>
				';
			}
			else {
				$mensajeParaAdmin .= '
					<p>
						Comprobante de pago: Boleta
					</p>
				';
			}

			$mensajeHTML = '

				<style>
					table {
						width: 100%;
						max-width: 850px;
						border-collapse: collapse;
					}
					table th {
						font-weight: bold;
					}
					th, td {
					  border: 1px solid #000000;
					}
				</style>

				<table>
          <thead>
            <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Total</th>
            </tr>
          </thead>
          
          <tbody>
		  ';

		  foreach (session('carrito')  as $key => $value) {

		  	$mensajeHTML .= '
	            
          <tr>
            <td class="product-text">
            	' . $value['nombre'] . '
            	<br>
            	Codigo: ' . $value['codigo'] . '
            </td>
            <td class="product-text">
            	' . $value['cantidad'] . '
            </td>
            <td class="product-text">
              S/. ' . $value['precio_t'] . '
            </td>
          </tr>
		  	';
	    }
		             
		  $mensajeHTML .= '
          </tbody>

        	<tfoot>
            <tr class="total">
              <th colspan="2"><strong>Subtotal</strong></th>
              <td><strong>S/. '.session('total').'</strong></td>
            </tr>
            <tr class="total">
              <th colspan="2"><strong>Costo de envio</strong></th>
              <td><strong>S/. '.$request->delivery.'</strong></td>
            </tr>
            <tr class="total">
              <th colspan="2"><strong>Total</strong></th>
              <td><strong>S/. '.(session('total') + $request->delivery).'</strong></td>
            </tr>
          </tfoot>
        </table>
			';

			$enviarMensaje = $enviarMensaje . '<br>' . $mensajeHTML;
			$mensajeParaAdmin = $mensajeParaAdmin . '<br>' . $mensajeHTML;

			$enviar = $this->enviarEmail($request->email, $configuraciones->email, 'Tukrea - Su compra ha sido realizada', $enviarMensaje);

			$enviar2 = $this->enviarEmail($configuraciones->email, $request->email,  'Tukrea - Pedido realizado', $mensajeParaAdmin);
		}	

		//borrar session carrito y total
		session()->forget('carrito');
		session()->forget('total');

		if($request->cliente == 0) {
			return redirect()->route('gracias.invitado');
		}
		else {
			return redirect()->route('gracias');
		}	

	}

	public function misPedidos() {

		if(!Auth::guard('clientes')->check()) {
      return redirect()->route('clientes.login');
    }

		$email = Auth::guard('clientes')->user()->email;

		$cliente = App\Clientes::firstOrFail()->where('email', $email)->first();
		$pedidos = App\Pedidos::select()->where('id_cliente', $cliente->id)->OrderBy('created_at', 'desc')->get();

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.pedidos', compact(['categorias', 'destacados', 'pedidos', 'configuraciones']));
	}

	public function miPedido($id) {

		if(!Auth::guard('clientes')->check()) {
      return redirect()->route('clientes.login');
    }

    $email = Auth::guard('clientes')->user()->email;

    $cliente = App\Clientes::firstOrFail()->where('email', $email)->first();

		$datosPedido = App\Pedidos::findOrFail($id);

		if($datosPedido->id_cliente != $cliente->id) {
			return redirect()->route('clientes.pedidos');
		}

		$datosDetalle = App\DetallePedidos::firstOrFail()->where('id_pedido', $id)->get();

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->OrderBy('orden', 'asc')
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		return view('web.pedido', compact(['categorias', 'destacados', 'configuraciones', 'datosPedido', 'datosDetalle']));
	}

	public function subirVoucher(Request $request, $id) {
		if(!Auth::guard('clientes')->check()) {
      return redirect()->route('clientes.login');
    }

    $datosPedido = App\Pedidos::findOrFail($id);

    if($request->hasfile('imagen')) {
			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/vouchers/', $nombre);

		  $datosPedido->voucher = 'images/vouchers/'.$nombre;
		  $datosPedido->estado = 'Pendiente de confirmacion';
		  $datosPedido->save();
		}

		return back(); 

	}

	public function gracias() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		$templateCarrito = true;

		return view('web.gracias', compact(['categorias', 'templateCarrito', 'destacados', 'configuraciones']));
	}

	public function graciasInvitado() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		$templateCarrito = true;

		return view('web.graciasinvitado', compact(['categorias', 'templateCarrito', 'destacados', 'configuraciones']));
	}

	public function contactoGracias() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		$templateCarrito = true;

		return view('web.graciascontacto', compact(['categorias', 'templateCarrito', 'destacados', 'configuraciones']));

	}

	public function listadoEscolar() {

		$configuraciones = App\Configuraciones::findOrFail(1);
		$categorias = App\Categorias::firstOrFail()
		->where('activo', 1)
		->get();
		
		$promociones = App\Promociones::findOrFail(1);
		$arrayPromociones = explode(',', $promociones->productos);
		$destacados = App\Productos::firstOrFail()->whereIn('id', $arrayPromociones)->get();

		$colegios = App\Listado::selectRaw('id_colegio, (SELECT b.nombre FROM colegios b WHERE id_colegio = b.id) as nombre_colegio')
    ->groupBy('id_colegio')
    ->get();

		return view('web.listado', compact(['categorias', 'destacados', 'configuraciones', 'colegios']));
	}

	public function getNiveles(Request $request) {

		$grados = App\Listado::selectRaw('id_colegio, id_nivel, (SELECT b.nombre FROM niveles b WHERE id_nivel = b.id) as nombre_nivel')
    ->where('id_colegio', $request->id_colegio)
    ->groupBy('id_colegio', 'id_nivel')
    ->get();

    return json_encode($grados);
	}

	public function getGrados(Request $request) {

		$grados = App\Listado::selectRaw('id_colegio, id_nivel, id_grado, (SELECT b.nombre FROM grados b WHERE id_grado = b.id) as nombre_grado')
    ->where('id_colegio', $request->id_colegio)
    ->where('id_nivel', $request->id_nivel)
    ->groupBy('id_colegio', 'id_nivel', 'id_grado')
    ->get();

    return json_encode($grados);
	}

	public function getListado(Request $request) {

		$listado = App\Listado::firstOrFail()
    ->where('id_colegio', $request->id_colegio)
    ->where('id_nivel', $request->id_nivel)
    ->where('id_grado', $request->id_grado)
    ->first();

		$productos = App\ListadosProductos::selectRaw('id_listado, id_producto, cantidad, (SELECT b.codigo FROM productos b WHERE id_producto = b.id) as codigo, (SELECT c.url FROM productos c WHERE id_producto = c.id) as url, (SELECT d.imagen FROM productos d WHERE id_producto = d.id) as imagen')
    ->where('id_listado', $listado->id)
    ->get();

    $token = $this->getToken();
		$client = new Client();

		$listaProductos = [];

    foreach($productos as $producto){

    	$responseProductos = $client->request(
				'POST',
		    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/Producto/GetProductoByFilter',
		    [
		    	'headers' => [ 'Authorization' => "Bearer {$token}" ],
	        'json' => [
						"idcodi" => "",
						"codigo" => $producto->codigo,
						"producto" => "",
						"marca" => "",
						"codmarca" => "",
						"codalm" => "",
						"codcli" => "C00000",
						"codlocal" => "001",
						"codcdv" => "01",
						"codusu" => "050",
						"tipoquery" => 1
	        ]
		    ]
			);

			$productoWS = json_decode($responseProductos->getBody()->getContents(), true);

			if(isset($productoWS['data'][0])){
				$datosWS = $productoWS['data'][0];

				array_push($listaProductos, [
					'id' => $producto->id_producto,
					'codigo' => $producto->codigo,
					'url' => $producto->url,
					'imagen' => $producto->imagen,
					'nombre' => $datosWS['descr'],
					'stock' => $datosWS['stock'],
					'precio' => $datosWS['pvns'],
					'cantidad' => $producto->cantidad
				]);
			}
    }

    return json_encode($listaProductos);
	}

	public function addListado(Request $request) {

		$listaProductos = json_decode($request->listado);

		foreach($listaProductos as $producto) {

			if($producto->stock <= 0) {
				continue;
			}

			$cantidad = $producto->cantidad;

			if($producto->cantidad > $producto->stock) {
				$cantidad = intval($producto->stock);
			}

			$id_item = $producto->id;
	    $detalle = array('cantidad' => $cantidad);

	    $detalle['id'] = $producto->id;
	    $detalle['url'] = $producto->url;
	    $detalle['nombre'] = $producto->nombre;
	    $detalle['imagen'] = $producto->imagen;
	    $detalle['codigo'] = $producto->codigo;
	    $detalle['precio_u'] = number_format($producto->precio, 2, '.', '');
	    $detalle['precio_t'] = number_format(($detalle['cantidad'] * $detalle['precio_u']), 2, '.', '');

	    $prod_md5 = md5($detalle['nombre'] . $detalle['id']);
	    $detalle['codigo_md5'] = $prod_md5;

			if(session('carrito.' . $prod_md5)) {

				$acumularCantidad = session('carrito.' . $prod_md5 . '.cantidad') + $cantidad;
				$request->session()->put('carrito.' . $prod_md5 . '.cantidad', $acumularCantidad);

	      $newCantidad = session('carrito.' . $prod_md5 . '.cantidad');

	      $acumularTotal = session('carrito.' . $prod_md5 . '.precio_u') * $newCantidad;
	      $request->session()->put('carrito.' . $prod_md5 . '.precio_t', $acumularTotal);

	      /* Actualizar el total del carrito */
	      $total = 0;
	      foreach(session('carrito') as $key => $value) {
	        $total += $value['precio_t'];
	      }

	      $request->session()->put('total', number_format($total, 2, '.', ''));
	    } 
	    else {
	    	$request->session()->put('carrito.' . $prod_md5, $detalle);
	      $request->session()->put('carrito.' . $prod_md5 . '.total', 0);

	      /* Actualizar el total del carrito */
	      $total = 0;
	      foreach (session('carrito')  as $key => $value) {
	        $total += $value['precio_t'];
	      }

	      $request->session()->put('total', number_format($total, 2, '.', ''));
	    }
			
		}
		
    return 'ok';
	}

	//----------------------------------------------------------------------
	//ubigeos
	public function getDepartamentos() {
		$departamentos = DB::table('ubigeo_peru_departments')->get();

		return $departamentos;
	}

	public function getProvincias(Request $request) {
		$provincias = DB::table('ubigeo_peru_provinces')
		->where('department_id', $request->id)
		->get();

		return $provincias;
	}

	public function getDistritos(Request $request) {
		$distritos = DB::table('ubigeo_peru_districts')
		->where('province_id', $request->id)
		->get();

		return $distritos;
	}

}
