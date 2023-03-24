<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;
use DB;
use GuzzleHttp\Client;

class AdminController extends Controller {

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

	public function test() {
		$token = $this->getToken();

		$client = new Client();

		$responseProductos = $client->request(
			'POST',
	    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/Producto/GetProductoByFilter',
	    [
	    	'headers' => [ 'Authorization' => "Bearer {$token}" ],
        'json' => [
					"idcodi" => "",
					"codigo" => "",
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

		$productos = json_decode($responseProductos->getBody()->getContents(), true);
		$productosWS = $productos['data'];

		dd($productosWS);
	}

	public function inicio() {
		return view('admin.inicio');
	}

	//----------------------------------------------------------------------
	//login
	public function getLogin() {

		if(Auth::check()) {
      return redirect()->route('admin.inicio');
    }

		return view('admin.login');
	}

	public function postLogin(Request $request) {

    $usuario = $request->input('usuario');
    $password = $request->input('password');

    if(Auth::attempt(['usuario' => $usuario, 'password' => $password])) {
			return redirect()->route('admin.inicio');
    }

    return back()->with('mensaje', 'Usuario o password incorrectos');

	}

	public function logout(Request $request) {

    Auth::logout();
  	return redirect()->route('login');
	}

	//----------------------------------------------------------------------
	//configuraciones
	public function configuraciones() {

		$datos = App\Configuraciones::findOrFail(1);

		return view('admin.configuraciones', compact('datos'));
	}

	public function editarConfiguraciones(Request $request) {

		$datosEditar = App\Configuraciones::findOrFail(1);
		$datosEditar->email = $request->email == null ? '' : $request->email;
		$datosEditar->email_copia = $request->email_copia == null ? '' : $request->email_copia;

		$datosEditar->direccion1 = $request->direccion1 == null ? '' : $request->direccion1;
		$datosEditar->telefono1 = $request->telefono1 == null ? '' : $request->telefono1;
		$datosEditar->direccion2 = $request->direccion2 == null ? '' : $request->direccion2;
		$datosEditar->telefono2 = $request->telefono2 == null ? '' : $request->telefono2;
		$datosEditar->telefono3 = $request->telefono3 == null ? '' : $request->telefono3;

		$datosEditar->productos_maximo = $request->productos_maximo == null ? '' : $request->productos_maximo;

		$datosEditar->email1 = $request->email1 == null ? '' : $request->email1;
		$datosEditar->email2 = $request->email2 == null ? '' : $request->email2;	
		
		$datosEditar->facebook = $request->facebook == null ? '' : $request->facebook;
		$datosEditar->twitter = $request->twitter == null ? '' : $request->twitter;
		$datosEditar->instagram = $request->instagram == null ? '' : $request->instagram;
		$datosEditar->youtube = $request->youtube == null ? '' : $request->youtube;

		$datosEditar->email_registro = $request->email_registro == null ? '' : $request->email_registro;
		$datosEditar->email_compra = $request->email_compra == null ? '' : $request->email_compra;
		$datosEditar->email_compra_deposito = $request->email_compra_deposito == null ? '' : $request->email_compra_deposito;
		/*$datosEditar->email_comprado = $request->email_comprado == null ? '' : $request->email_comprado;
		$datosEditar->email_no_comprado = $request->email_no_comprado == null ? '' : $request->email_no_comprado;*/

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//tarifario
	public function tarifario() {

		$datos = DB::table('ubigeo_peru_districts')
		->where('province_id', '1501')
		->orderBy('id', 'asc')
		->get();

		return view('admin.tarifario', compact('datos'));
	}

	public function editarTarifario(Request $request) {

    $listado = $request->listado;

		foreach($listado as $item) {
    	$item = str_replace('\\', '', $item);
      $dato = json_decode($item);

      DB::table('ubigeo_peru_districts')
      ->where('id', $dato->id)
      ->update(['costo' => $dato->costo]);
    }

		return 'ok';
	}

	//----------------------------------------------------------------------
	//contacto
	public function contacto() {

		$datos = App\Contacto::findOrFail(1);

		return view('admin.contacto', compact('datos'));
	}

	public function editarContacto(Request $request) {

		$datosEditar = App\Contacto::findOrFail(1);
		$datosEditar->texto = $request->texto == null ? '' : $request->texto;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//Filosofia
	public function filosofia() {

		$datos = App\Filosofia::findOrFail(1);

		return view('admin.filosofia', compact('datos'));
	}

	public function editarFilosofia(Request $request) {

		$datosEditar = App\Filosofia::findOrFail(1);
		$datosEditar->titulo1 = $request->titulo1 == null ? '' : $request->titulo1;
		$datosEditar->texto1 = $request->texto1 == null ? '' : $request->texto1;
		$datosEditar->titulo2 = $request->titulo2 == null ? '' : $request->titulo2;
		$datosEditar->texto2 = $request->texto2 == null ? '' : $request->texto2;
		$datosEditar->titulo3 = $request->titulo3 == null ? '' : $request->titulo3;
		$datosEditar->texto3 = $request->texto3 == null ? '' : $request->texto3;
		$datosEditar->titulo4 = $request->titulo4 == null ? '' : $request->titulo4;
		$datosEditar->texto4 = $request->texto4 == null ? '' : $request->texto4;
		$datosEditar->titulo5 = $request->titulo5 == null ? '' : $request->titulo5;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	public function entradas() {

		$entradas = App\FilosofiaEntradas::select()->paginate(25);		

		return view('admin.entradas', compact('entradas'));
	}

	public function crearEntrada() {	

		return view('admin.entradascrear');
	}

	public function putCrearEntrada(Request $request) {	

		$entrada = new App\FilosofiaEntradas;
		$entrada->titulo = $request->titulo == null ? '' : $request->titulo;
		$entrada->texto = $request->texto == null ? '' : $request->texto;

		if($request->hasfile('imagen')) {

			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/filosofia/', $nombre);

		  $entrada->imagen = 'images/filosofia/'.$nombre;
		}
		else {
			$entrada->imagen = '';
		}

		$entrada->save();

		return back()->with('mensaje', 'Dato creado');
	}

	public function editarEntrada($id) {	

		$datos = App\FilosofiaEntradas::select()->where('id', $id)->first();

		return view('admin.entradaseditar', compact('datos'));
	}

	public function putEditarEntrada(Request $request, $id) {	

		$entrada = App\FilosofiaEntradas::firstOrFail()->where('id', $id)->first();
		$entrada->titulo = $request->titulo == null ? '' : $request->titulo;
		$entrada->texto = $request->texto == null ? '' : $request->texto;

		if($request->hasfile('imagen')) {

			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/filosofia/', $nombre);

		  $entrada->imagen = 'images/filosofia/'.$nombre;
		}

		$entrada->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	public function eliminarEntrada($id) {	

		$entrada = App\FilosofiaEntradas::firstOrFail()->where('id', $id)->first();
		$entrada->delete();

		return back()->with('mensaje', 'Dato eliminado');
	}

	//----------------------------------------------------------------------
	//portada
	public function portada() {

		$datos = App\Portada::findOrFail(1);

		return view('admin.portada', compact('datos'));
	}

	public function editarPortada(Request $request) {

		$datosEditar = App\Portada::findOrFail(1);
		$datosEditar->titulo1 = $request->titulo1 == null ? '' : $request->titulo1;
		$datosEditar->texto1 = $request->texto1 == null ? '' : $request->texto1;
		$datosEditar->titulo2 = $request->titulo2 == null ? '' : $request->titulo2;
		$datosEditar->texto2 = $request->texto2 == null ? '' : $request->texto2;
		$datosEditar->titulo2b = $request->titulo2b == null ? '' : $request->titulo2b;
		$datosEditar->texto2b = $request->texto2b == null ? '' : $request->texto2b;
		$datosEditar->titulo3 = $request->titulo3 == null ? '' : $request->titulo3;
		$datosEditar->texto3 = $request->texto3 == null ? '' : $request->texto3;
		$datosEditar->titulo4 = $request->titulo4 == null ? '' : $request->titulo4;
		$datosEditar->texto4 = $request->texto4 == null ? '' : $request->texto4;

    if($request->hasfile('imagen')) {
			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/', $nombre);

		  $datosEditar->imagen = 'images/'.$nombre;
		}

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//nosotros
	public function nosotros() {

		$datos = App\Nosotros::findOrFail(1);

		return view('admin.nosotros', compact('datos'));
	}

	public function editarNosotros(Request $request) {

		$datosEditar = App\Nosotros::findOrFail(1);
		$datosEditar->titulo = $request->titulo == null ? '' : $request->titulo;
		$datosEditar->texto = $request->texto == null ? '' : $request->texto;

		if($request->hasfile('imagen')) {
			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/', $nombre);

		  $datosEditar->imagen = 'images/'.$nombre;
		}

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//politicas
	public function politicas() {

		$datos = App\Politicas::findOrFail(1);

		return view('admin.politicas', compact('datos'));
	}

	public function editarPoliticas(Request $request) {

		$datosEditar = App\Politicas::findOrFail(1);
		$datosEditar->texto = $request->texto == null ? '' : $request->texto;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//productos
	public function productos(Request $request) {

		/*$grupos = App\Grupos::firstOrFail()->where('activo', 1)->get();

		$ids = [];
		foreach($grupos as $item) {
			$ids[] = $item->id;
		}*/

		if($request->has('buscar')) {
			$datos = App\Productos::select()
			->where('nombre', 'like', '%' . $request->buscar . '%')
			->orWhere('codigo', 'like', '%' . $request->buscar . '%')
			->appends('buscar', $request->buscar);
		}
		else {
			$datos = App\Productos::select()->get();
		}	
		
		return view('admin.productos', compact('datos'));
	}

	public function actualizarProductos() {

		//llamar al webservice
		$token = $this->getToken();

		$client = new Client();

		$responseProductos = $client->request(
			'POST',
	    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/Producto/GetProductoByFilter',
	    [
	    	'headers' => [ 'Authorization' => "Bearer {$token}" ],
        'json' => [
					"idcodi" => "",
					"codigo" => "",
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

		$productos = json_decode($responseProductos->getBody()->getContents(), true);
		$productosWS = $productos['data'];

		foreach($productosWS as $item){

			if(strlen(trim($item['idCodi'])) < 7) {
				continue;
			}

			//obtener grupo: 7 primeros digitos del codigo
			$codigoGrupo = substr($item['idCodi'], 0, 7);

			$codigoGrupo = substr($codigoGrupo, 0, 2) . '-' . substr($codigoGrupo, 2, 5);

			$datosBD = App\Productos::select()->where('codigo', $item['codigo'])->first();

			if($datosBD == null) {

				$datosBD = new App\Productos;
				$datosBD->codigo = $item['codigo'];
				$datosBD->nombre = $item['descr'];

				//crear el url a partir del nombre
				$url = mb_strtolower(trim($item['descr']));
				$url = str_replace(' ', '-', $url);
				$url = str_replace('/', '-', $url);
				$url = str_replace('.', '', $url);

				$datosBD->url = $url;
				$datosBD->activo = 0;
				$datosBD->idcodi = $codigoGrupo;
				$datosBD->id_grupo = 0;
				$datosBD->stock = intval($item['stock']);
				$datosBD->precio = $item['pvns'];
				$datosBD->resumen = '';
				$datosBD->descripcion = '';
				$datosBD->adicional = '';
				$datosBD->imagen = '';
				$datosBD->activar_colores = 0;
				$datosBD->activar_tallas = 0;
				$datosBD->activar_agrupar = 0;
				$datosBD->colores = '';
				$datosBD->tallas = '';
				$datosBD->ids_productos = '';
				$datosBD->en_grupo = 0;
				$datosBD->save();
			}
			else {
				$datosBD->codigo = $item['codigo'];
				$datosBD->nombre = $item['descr'];

				$url = mb_strtolower(trim($item['descr']));
				$url = str_replace(' ', '-', $url);
				$url = str_replace('/', '-', $url);
				$url = str_replace('.', '', $url);

				$datosBD->url = $url;
				$datosBD->idcodi = $codigoGrupo;
				$datosBD->id_grupo = 0;
				$datosBD->stock = intval($item['stock']);
				$datosBD->precio = $item['pvns'];
				$datosBD->save();
			}
		}

		echo 'ok';
	}

	public function producto($id) {

		$datos = App\Productos::findOrFail($id);
		$imagenes = App\ProductosImagenes::select()
		->where('id_producto', $id)
		->OrderBy('orden', 'asc')
		->get();

		$listaProductos = App\Productos::select()
		->where('id_grupo', $datos->id_grupo)
		->where('id', '!=', $id)
		->get();

		$colores = [];
		$tallas = [];

		if($datos->colores != '') {
			$colores = json_decode($datos->colores);
		}

		if($datos->tallas != '') {
			$tallas = json_decode($datos->tallas);
		}

		$categorias = App\Categorias::select()->OrderBy('orden', 'asc')->get();
		$niveles = App\Niveles::select()->OrderBy('orden', 'asc')->get();
		$grados = App\Grados::select()->OrderBy('orden', 'asc')->get();	

		return view('admin.producto', compact('datos', 'imagenes', 'colores', 'tallas', 'listaProductos', 'categorias', 'niveles', 'grados'));
	}

	public function editarProducto(Request $request, $id) {

		//validar url
		$productoUrl = App\Productos::firstOrFail()->where('url', $request->url)->where('id', '<>', $id)->first();

		if($productoUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$datosEditar = App\Productos::findOrFail($id);
		$datosEditar->activo = $request->activo == null ? 0 : 1;
		$datosEditar->id_categoria = $request->id_categoria;
		$datosEditar->id_grado = $request->id_grado;
		$datosEditar->nombre = $request->nombre == null ? '' : $request->nombre;
		$datosEditar->url = $request->url == null ? '' : $request->url;
		$datosEditar->resumen = $request->resumen == null ? '' : $request->resumen;
		$datosEditar->descripcion = $request->descripcion == null ? '' : $request->descripcion;
		$datosEditar->adicional = $request->adicional == null ? '' : $request->adicional;

		$datosEditar->activar_colores = $request->activar_colores == null ? 0 : 1;
		$datosEditar->activar_tallas = $request->activar_tallas == null ? 0 : 1;
		$datosEditar->activar_agrupar = $request->activar_agrupar == null ? 0 : 1;

		$datosEditar->colores = $request->lista_colores == null ? '' : $request->lista_colores;
		$datosEditar->tallas = $request->lista_tallas == null ? '' : $request->lista_tallas;

		$niveles = '';
		if($request->niveles != '') {
			foreach ($request->niveles as $nivel) {
				$niveles .= $nivel . ',';
			}

			$niveles = trim($niveles, ',');
		}	

		$datosEditar->niveles = $niveles;

		if($request->activar_agrupar != null) {
			
			//recoger productos antiguos y columna en_grupo = false
			if($datosEditar->ids_productos != '') {

				$ids_antiguos = explode(',', $datosEditar->ids_productos);

				foreach ($ids_antiguos as $item) {
					$antiguo = App\Productos::findOrFail($item);
					$antiguo->en_grupo = 0;
					$antiguo->save();
				}
			}

			//recorrer nueva lista y columna en_grupo = true
			$ids = '';

			if($request->ids_productos != '') {

				foreach ($request->ids_productos as $item) {

					$ids .= $item . ',';

					$variante = App\Productos::findOrFail($item);
					$variante->en_grupo = 1;
					$variante->save();
				}

				$ids = trim($ids, ',');
			}

			//guardar la lista de productos separados por comas
			$datosEditar->ids_productos = $ids;
		}

		if($request->hasfile('imagen')) {
			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/productos/', $nombre);

		  $datosEditar->imagen = 'images/productos/'.$nombre;
		}

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	public function subirImagen(Request $request, $id) {

		if($request->hasfile('file')) {

			$datos = new App\ProductosImagenes;
			$datos->id_producto = $id;
			$datos->orden = 0;

			$imagen = $request->file('file');
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/productos/', $nombre);

		  $datos->imagen = 'images/productos/' . $nombre;

		  $datos->save();

		  return 'ok';
		}
		else {
			return 'fail';
		}

	}

	public function eliminarImagen($id) {

		$datos = App\ProductosImagenes::findOrFail($id);
		$datos->delete();

		return back()->with('mensaje', 'Imagen eliminada');
	}

	public function ordenarImagenes(Request $request) {

    foreach($request->listado as $item) {
    	$item = str_replace('\\', '', $item);
      $dato = json_decode($item);

      $imagen = App\ProductosImagenes::findOrFail($dato->id);
      $imagen->orden = $dato->orden;
      $imagen->save();
    }

		return 'ok';
	}

	//----------------------------------------------------------------------
	//categorias
	public function categorias() {

		$categorias = App\Categorias::select()->OrderBy('orden', 'asc')->get();		

		return view('admin.categorias', compact('categorias'));
	}

	public function crearCategoria() {	

		return view('admin.categoriascrear');
	}

	public function putCrearCategoria(Request $request) {	

		$categoriaUrl = App\Categorias::select()
		->where('url', $request->url)
		->first();

		if($categoriaUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$categoria = new App\Categorias;
		$categoria->activo = $request->activo == null ? 0 : 1;
		$categoria->url = $request->url == null ? '' : $request->url;
		$categoria->nombre = $request->nombre == null ? '' : $request->nombre;
		$categoria->texto = $request->texto == null ? '' : $request->texto;
		$categoria->save();

		return back()->with('mensaje', 'Categoria creada');
	}

	public function editarCategoria($id) {	

		$datos = App\Categorias::firstOrFail()->where('id', $id)->first();

		return view('admin.categoriaseditar', compact('datos'));
	}

	public function putEditarCategoria(Request $request, $id) {	

		$categoriaUrl = App\Categorias::select()
		->where('url', $request->url)
		->where('id', '<>', $id)
		->first();

		if($categoriaUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$categoria = App\Categorias::firstOrFail()->where('id', $id)->first();
		$categoria->activo = $request->activo == null ? 0 : 1;
		$categoria->url = $request->url == null ? '' : $request->url;
		$categoria->nombre = $request->nombre == null ? '' : $request->nombre;
		$categoria->texto = $request->texto == null ? '' : $request->texto;
		$categoria->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	public function eliminarCategoria($id) {	

		$categoria = App\Categorias::firstOrFail()->where('id', $id)->first();
		$categoria->delete();

		return back()->with('mensaje', 'Categoria eliminada');
	}

	public function ordenarCategorias(Request $request) {	

		$listado = $request->listado;

    foreach ($listado as $item) {
    	$item = str_replace('\\', '', $item);
      $dato = json_decode($item);

      $categoria = App\Categorias::firstOrFail()->where('id', $dato->id)->first();
			$categoria->orden = $dato->orden;
			$categoria->save();
    }

		return 'ok';
	}

	//----------------------------------------------------------------------
	//grados
	public function grados() {

		$grados = App\Grados::select()->OrderBy('orden', 'asc')->get();		

		return view('admin.grados', compact('grados'));
	}

	public function crearGrado() {	

		return view('admin.gradoscrear');
	}

	public function putCrearGrado(Request $request) {	

		$grados = new App\Grados;
		$grados->nombre = $request->nombre == null ? '' : $request->nombre;
		$grados->orden = 0;
		$grados->save();

		return back()->with('mensaje', 'Grado creado');
	}

	public function editarGrado($id) {	

		$datos = App\Grados::firstOrFail()->where('id', $id)->first();

		return view('admin.gradoseditar', compact('datos'));
	}

	public function putEditarGrado(Request $request, $id) {	

		$grados = App\Grados::firstOrFail()->where('id', $id)->first();
		$grados->nombre = $request->nombre == null ? '' : $request->nombre;
		$grados->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	public function eliminarGrado($id) {	

		$grados = App\Grados::firstOrFail()->where('id', $id)->first();
		$grados->delete();

		return back()->with('mensaje', 'Grado eliminado');
	}

	public function ordenarGrados(Request $request) {	

		$listado = $request->listado;

    foreach ($listado as $item) {
    	$item = str_replace('\\', '', $item);
      $dato = json_decode($item);

      $grado = App\Grados::firstOrFail()->where('id', $dato->id)->first();
			$grado->orden = $dato->orden;
			$grado->save();
    }

		return 'ok';
	}

	//----------------------------------------------------------------------
	//familias
	public function familias(Request $request) {

		if($request->has('buscar')) {
			$familias = App\Categorias::select()
			->where('nombre', 'like', '%' . $request->buscar . '%')
			->orWhere('codigo', 'like', '%' . $request->buscar . '%')
			->paginate(25)
			->appends('buscar', $request->buscar);
		}
		else {
			$familias = App\Categorias::select()->paginate(25);
		}		

		return view('admin.familias', compact('familias'));
	}

	public function actualizarFamilias() {

		$token = $this->getToken();

		$client = new Client();

		$response = $client->request(
			'GET',
	    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/Producto/GetTblClasifPrd',
	    [
	    	'headers' => [ 'Authorization' => "Bearer {$token}" ]
	    ]
		);

		$familias = json_decode($response->getBody()->getContents(), true);

		$familiasWS = $familias['data']['familia'];

		foreach($familiasWS as $item){
			$datosBD = App\Categorias::firstOrFail()->where('codigo', $item['codFam'])->first();

			if($datosBD == null) {
				$datosBD = new App\Categorias;
				$datosBD->codigo = $item['codFam'];
				$datosBD->nombre = trim($item['nomFam']);
				$datosBD->url = '';
				$datosBD->imagen = '';
				$datosBD->banner = '';
				$datosBD->resumen = '';
				$datosBD->descripcion = '';
				$datosBD->save();
			}
			else {
				$datosBD->codigo = $item['codFam'];
				$datosBD->nombre = trim($item['nomFam']);
				$datosBD->save();
			}
		}

		return 'ok';
	}

	public function familia($id) {

		$datos = App\Categorias::firstOrFail()->where('id', $id)->first();

		return view('admin.familia', compact('datos'));
	}

	public function editarFamilia(Request $request, $id) {

		//validar url
		$familiaUrl = App\Categorias::firstOrFail()->where('url', $request->url)->where('id', '<>', $id)->first();

		if($familiaUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$datosEditar = App\Categorias::findOrFail($id);
		$datosEditar->url = $request->url == null ? '' : $request->url;
		$datosEditar->nombre = $request->nombre == null ? '' : $request->nombre;
		$datosEditar->resumen = $request->resumen == null ? '' : $request->resumen;
		$datosEditar->descripcion = $request->descripcion == null ? '' : $request->descripcion;
		$datosEditar->activo = $request->activo == null ? 0 : 1;

		if($request->hasfile('imagen')) {
			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/familias/', $nombre);

		  $datosEditar->imagen = 'images/familias/'.$nombre;
		}

		if($request->hasfile('banner')) {
			$imagen = $request->file('banner');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/familias/', $nombre);

		  $datosEditar->banner = 'images/familias/'.$nombre;
		}

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//subfamilias
	public function subfamilias(Request $request) {

		$familias = App\Categorias::firstOrFail()->where('activo', 1)->get();

		$ids = [];
		foreach($familias as $item) {
			$ids[] = $item->id;
		}

		if($request->has('buscar')) {
			$datos = App\Subfamilias::select(
				'*',
				DB::raw("(SELECT b.nombre FROM categorias b WHERE id_categoria = b.id) as nombre_familia")
			)
			->whereIn('id_categoria', $ids)
			->where('nombre', 'like', '%' . $request->buscar . '%')
			->orWhere('codigo', 'like', '%' . $request->buscar . '%')
			->paginate(25)
			->appends('buscar', $request->buscar);
		}
		else {
			$datos = App\Subfamilias::select(
				'*',
				DB::raw("(SELECT b.nombre FROM categorias b WHERE id_categoria = b.id) as nombre_familia")
			)
			->whereIn('id_categoria', $ids)
			->paginate(25);
		}

		return view('admin.subfamilias', compact('datos'));
	}

	public function actualizarSubfamilias() {

		$familias = App\Categorias::firstOrFail()->where('activo', 1)->get();

		$codigos = [];
		$objFamilias = [];

		foreach($familias as $item) {
			$codigos[] = $item->codigo;

			array_push($objFamilias, (object)[
        'id' => $item->id,
        'codigo' => $item->codigo
			]); 
		}

		$token = $this->getToken();

		$client = new Client();

		$response = $client->request(
			'GET',
	    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/Producto/GetTblClasifPrd',
	    [
	    	'headers' => [ 'Authorization' => "Bearer {$token}" ]
	    ]
		);

		$subfamilias = json_decode($response->getBody()->getContents(), true);

		$subfamiliasWS = $subfamilias['data']['subfamilia'];

		foreach($subfamiliasWS as $item){

			//obtener familia: 2 primeros digitos del codigo
			$codigoFamilia = substr($item['codSub'], 0, 2);

			//si el codigo de familia no esta en la lista de familias activas
			if(!in_array($codigoFamilia, $codigos)) {
				continue;
			}

			$datosBD = App\Subfamilias::select()->where('codigo', $item['codSub'])->first();

			if($datosBD == null) {

				//buscar el id de la familia segun el codigo
				$id_categoria = 0;
				foreach($objFamilias as $objItem){

					if($codigoFamilia == $objItem->codigo){
						$id_categoria = $objItem->id;
					}
				}

				//si pertenece a las familias activas guardar en BD
				if($id_categoria != 0){
					$datosBD = new App\Subfamilias;
					$datosBD->codigo = $item['codSub'];
					$datosBD->nombre = trim($item['nomSub']);

					//crear el url a partir del nombre
					$url = mb_strtolower(trim($item['nomSub']));
					$url = str_replace(' ', '-', $url);
					$datosBD->url = $url;
					$datosBD->activo = 1;
					$datosBD->id_categoria = $id_categoria;
					$datosBD->save();
				}
			}
			else {
				$datosBD->codigo = $item['codSub'];
				$datosBD->nombre = trim($item['nomSub']);
				$datosBD->save();
			}
		}

		return 'ok';
	}

	public function subfamilia($id) {

		$datos = App\Subfamilias::firstOrFail()->where('id', $id)->first();

		return view('admin.subfamilia', compact('datos'));
	}

	public function editarSubfamilia(Request $request, $id) {

		//validar url
		$subfamiliaUrl = App\Subfamilias::firstOrFail()->where('url', $request->url)->where('id', '<>', $id)->first();

		if($subfamiliaUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$datosEditar = App\Subfamilias::findOrFail($id);
		$datosEditar->url = $request->url == null ? '' : $request->url;
		$datosEditar->nombre = $request->nombre == null ? '' : $request->nombre;
		$datosEditar->activo = $request->activo == null ? 0 : 1;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//grupos
	public function grupos(Request $request) {

		$subfamilias = App\Subfamilias::firstOrFail()->where('activo', 1)->get();

		$ids = [];
		foreach($subfamilias as $item) {
			$ids[] = $item->id;
		}

		if($request->has('buscar')) {
			$datos = App\Grupos::select(
				'*',
				DB::raw("(SELECT b.nombre FROM subfamilias b WHERE id_subfamilia = b.id) as nombre_subfamilia")
			)
			->whereIn('id_subfamilia', $ids)
			->where('nombre', 'like', '%' . $request->buscar . '%')
			->orWhere('codigo', 'like', '%' . $request->buscar . '%')
			->paginate(25)
			->appends('buscar', $request->buscar);
		}
		else {
			$datos = App\Grupos::select(
				'*',
				DB::raw("(SELECT b.nombre FROM subfamilias b WHERE id_subfamilia = b.id) as nombre_subfamilia")
			)
			->whereIn('id_subfamilia', $ids)
			->paginate(25);
		}

		return view('admin.grupos', compact('datos'));
	}

	public function actualizarGrupos() {

		$familias = App\Categorias::firstOrFail()->where('activo', 1)->get();

		$ids = [];
		foreach($familias as $item) {
			$ids[] = $item->id;
		}

		$subfamilias = App\Subfamilias::select()->whereIn('id_categoria', $ids)->where('activo', 1)->get();

		$codigos = [];
		$objSubfamilias = [];

		foreach($subfamilias as $item) {
			$codigos[] = $item->codigo;

			array_push($objSubfamilias, (object)[
        'id' => $item->id,
        'codigo' => $item->codigo
			]); 
		}

		$token = $this->getToken();

		$client = new Client();

		$response = $client->request(
			'GET',
	    'http://181.224.241.203:4402/WA_NavaSoft_Iweb00/api/Producto/GetTblClasifPrd',
	    [
	    	'headers' => [ 'Authorization' => "Bearer {$token}" ]
	    ]
		);

		$grupos = json_decode($response->getBody()->getContents(), true);

		$gruposWS = $grupos['data']['grupo'];

		foreach($gruposWS as $item){

			//obtener familia: 2 primeros digitos del codigo
			$codigoSubfamilia = substr($item['codGrp'], 0, 5);

			if(trim($codigoSubfamilia) == '') {
				continue;
			}

			//si el codigo de familia no esta en la lista de familias activas
			if(!in_array($codigoSubfamilia, $codigos)) {
				continue;
			}

			$datosBD = App\Grupos::select()->where('codigo', $item['codGrp'])->first();

			if($datosBD == null) {

				//buscar el id de la familia segun el codigo
				$id_subfamilia = 0;
				foreach($objSubfamilias as $objItem){

					if($codigoSubfamilia == $objItem->codigo){
						$id_subfamilia = $objItem->id;
					}
				}

				//si pertenece a las familias activas guardar en BD
				if($id_subfamilia != 0){
					$datosBD = new App\Grupos;
					$datosBD->codigo = $item['codGrp'];
					$datosBD->nombre = trim($item['nomGrp']);

					//crear el url a partir del nombre
					$url = mb_strtolower(trim($item['nomGrp']));
					$url = str_replace(' ', '-', $url);

					$datosBD->url = $url;
					$datosBD->activo = 1;
					$datosBD->id_subfamilia = $id_subfamilia;
					$datosBD->save();
				}
			}
			else {
				$datosBD->codigo = $item['codGrp'];
				$datosBD->nombre = trim($item['nomGrp']);
				$datosBD->save();
			}
		}

		echo 'ok';
	}

	public function grupo($id) {

		$datos = App\Grupos::firstOrFail()->where('id', $id)->first();

		return view('admin.grupo', compact('datos'));
	}

	public function editarGrupo(Request $request, $id) {

		//validar url
		$grupoUrl = App\Grupos::firstOrFail()->where('url', $request->url)->where('id', '<>', $id)->first();

		if($grupoUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$datosEditar = App\Grupos::findOrFail($id);
		$datosEditar->url = $request->url == null ? '' : $request->url;
		$datosEditar->nombre = $request->nombre == null ? '' : $request->nombre;
		$datosEditar->activo = $request->activo == null ? 0 : 1;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//clientes
	public function clientes() {

		$clientes = App\Clientes::all();

		return view('admin.clientes', compact('clientes'));
	}

	public function cliente(Request $request, $id) {

		$datos = App\Clientes::findOrFail($id);

		return view('admin.cliente', compact('datos'));
	}

	public function editarCliente(Request $request, $id) {

		$datosEditar = App\Clientes::findOrFail($id);
		//$datosEditar->email = $request->email == null ? '' : $request->email;
		$datosEditar->ruc = $request->ruc == null ? '' : $request->ruc;
		$datosEditar->razon_social = $request->razon_social == null ? '' : $request->razon_social;
		$datosEditar->nombre = $request->nombre == null ? '' : $request->nombre;
		$datosEditar->apellidos = $request->apellidos == null ? '' : $request->apellidos;
		$datosEditar->dni = $request->dni == null ? '' : $request->dni;
		$datosEditar->telefono = $request->telefono == null ? '' : $request->telefono;
		$datosEditar->celular = $request->celular == null ? '' : $request->celular;
		$datosEditar->ciudad = $request->ciudad == null ? '' : $request->ciudad;
		$datosEditar->distrito = $request->distrito == null ? '' : $request->distrito;
		$datosEditar->direccion = $request->direccion == null ? '' : $request->direccion;
		$datosEditar->activo = $request->activo == null ? 0 : 1;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//pedidos
	public function pedidos() {

		$datos = App\Pedidos::select()->orderBy('id', 'desc')->get();

		return view('admin.pedidos', compact('datos'));
	}

	public function pedido($id) {

		$datos = App\Pedidos::findOrFail($id);
		$detalle = App\DetallePedidos::firstOrFail()->where('id_pedido', $id)->get();

		return view('admin.pedido', compact(['datos', 'detalle']));
	}

	public function rechazarVoucher(Request $request, $id) {
		
		$pedido = App\Pedidos::findOrFail($id);
		$pedido->voucher = '';
		$pedido->estado = 'Pendiente de pago';
		$pedido->save();

		$configuraciones = App\Configuraciones::findOrFail(1);

		$mensaje = '
			<p>Su voucher de deposito bancario ha sido rechazado por el siguiente motivo:</p>
			<br>
			<p><strong>'.$request->motivo.'</strong></p>
			<br>
			<p>Favor de revisar su voucher antes de volver a subirlo.</p>
		';

		//$para, $email, $titulo, $mensaje
		$enviar = $this->enviarEmail($pedido->email, $configuraciones->email, 'Tukrea - voucher de deposito rechazado', $mensaje);

		return back()->with('mensaje', 'Voucher rechazado');
	}

	public function getPedido(Request $request) {

		$datos = App\Pedidos::findOrFail($request->id);

		return $datos->toJson();
	}

	public function getDetalle(Request $request) {

		$datos = App\DetallePedidos::firstOrFail()->where('id_pedido', $request->id)->get();

		return $datos->toJson();
	}

	public function cambiarEstado(Request $request) {

		$datos = App\Pedidos::findOrFail($request->id);
		$datos->estado = $request->estado;
		$datos->save();

		return 'ok';
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

	//----------------------------------------------------------------------
	//slider
	public function slider() {

		$datos = App\Slider::all();

		return view('admin.slider', compact('datos'));
	}

	public function sliderCrear() {

		return view('admin.slidercrear');
	}

	public function sliderPutCrear(Request $request) {

		$datos = new App\Slider;
		$datos->url = $request->url == null ? '' : $request->url;

		if($request->hasfile('imagen')) {

			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/slider/', $nombre);

		  $datos->imagen = 'images/slider/'.$nombre;
		}
		else {
			return back()->with('mensajeError', 'Debe ingresar una imagen');
		}

		$datos->save();
		
		return back()->with('mensaje', 'Imagen creada');
	}

	public function sliderEliminar($id) {

		$datos = App\Slider::findOrFail($id);
		$datos->delete();

		return back()->with('mensaje', 'Imagen eliminada');
	}

	public function sliderEditar($id) {

		$datos = App\Slider::findOrFail($id);

		return view('admin.slidereditar', compact('datos'));
	}

	public function sliderPutEditar(Request $request) {

		$datos = App\Slider::findOrFail($request->id);
		$datos->url = $request->url == null ? '' : $request->url;

		if($request->hasfile('imagen')) {

			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/slider/', $nombre);

		  $datos->imagen = 'images/slider/'.$nombre;
		}

		$datos->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//listado escolar
	public function colegios() {

		$datos = App\Colegios::all();

		return view('admin.colegios', compact('datos'));
	}

	public function colegiosCrear() {

		return view('admin.colegioscrear');
	}

	public function colegiosPutCrear(Request $request) {

		$datos = new App\Colegios;
		$datos->nombre = $request->nombre == null ? '' : $request->nombre;
		$datos->save();

		return back()->with('mensaje', 'Colegio creado');
	}

	public function colegiosEliminar($id) {

		$datos = App\Colegios::findOrFail($id);
		$datos->delete();

		return back()->with('mensaje', 'Colegio eliminado');
	}

	public function colegiosEditar($id) {

		$datos = App\Colegios::findOrFail($id);

		return view('admin.colegioseditar', compact('datos'));
	}

	public function colegiosPutEditar(Request $request) {

		$datos = App\Colegios::findOrFail($request->id);
		$datos->nombre = $request->nombre == null ? '' : $request->nombre;
		$datos->save();

		return back()->with('mensaje', 'Colegio actualizado');
	}

	//niveles
	public function niveles() {

		$datos = App\Niveles::select()->OrderBy('orden', 'asc')->get();

		return view('admin.niveles', compact('datos'));
	}

	public function nivelesCrear() {

		return view('admin.nivelescrear');
	}

	public function nivelesPutCrear(Request $request) {

		$datos = new App\Niveles;
		$datos->nombre = $request->nombre == null ? '' : $request->nombre;
		$datos->save();

		return back()->with('mensaje', 'Nivel creado');
	}

	public function nivelesEliminar($id) {

		$datos = App\Niveles::findOrFail($id);
		$datos->delete();

		return back()->with('mensaje', 'Nivel eliminado');
	}

	public function nivelesEditar($id) {

		$datos = App\Niveles::findOrFail($id);

		return view('admin.niveleseditar', compact('datos'));
	}

	public function nivelesPutEditar(Request $request) {

		$datos = App\Niveles::findOrFail($request->id);
		$datos->nombre = $request->nombre == null ? '' : $request->nombre;
		$datos->save();

		return back()->with('mensaje', 'Nivel actualizado');
	}

	public function ordenarNiveles(Request $request) {	

		$listado = $request->listado;

    foreach ($listado as $item) {
    	$item = str_replace('\\', '', $item);
      $dato = json_decode($item);

      $nivel = App\Niveles::firstOrFail()->where('id', $dato->id)->first();
			$nivel->orden = $dato->orden;
			$nivel->save();
    }

		return 'ok';
	}

	//grados
	/*public function grados() {

		$datos = App\Grados::all();

		return view('admin.grados', compact('datos'));
	}

	public function gradosCrear() {

		return view('admin.gradoscrear');
	}

	public function gradosPutCrear(Request $request) {

		$datos = new App\Grados;
		$datos->nombre = $request->nombre == null ? '' : $request->nombre;
		$datos->save();

		return back()->with('mensaje', 'Grado creado');
	}

	public function gradosEliminar($id) {

		$datos = App\Grados::findOrFail($id);
		$datos->delete();

		return back()->with('mensaje', 'Grado eliminado');
	}

	public function gradosEditar($id) {

		$datos = App\Grados::findOrFail($id);

		return view('admin.gradoseditar', compact('datos'));
	}

	public function gradosPutEditar(Request $request) {

		$datos = App\Grados::findOrFail($request->id);
		$datos->nombre = $request->nombre == null ? '' : $request->nombre;
		$datos->save();

		return back()->with('mensaje', 'Grado actualizado');
	}*/

	//listado escolar
	public function listado() {

		$datos = App\Listado::select('*',
		DB::raw("(SELECT b.nombre FROM colegios b WHERE id_colegio = b.id) as nombre_colegio"),
		DB::raw("(SELECT c.nombre FROM niveles c WHERE id_nivel = c.id) as nombre_nivel"),
		DB::raw("(SELECT d.nombre FROM grados d WHERE id_grado = d.id) as nombre_grado"),
		DB::raw("(SELECT count(*) FROM listados_productos WHERE listados_productos.id_listado = listados.id) as conteo"))
		->get();

		return view('admin.listado', compact('datos'));
	}

	public function listadoCrear() {

		$colegios = App\Colegios::all();
		$niveles = App\Niveles::all();
		$grados = App\Grados::all();
		$productos = App\Productos::firstOrFail()->where('activo', '1')->get();

		return view('admin.listadocrear', compact('colegios', 'niveles', 'grados', 'productos'));
	}

	public function listadoPutCrear(Request $request) {

		$datos = new App\Listado;
		$datos->id_colegio = $request->id_colegio;
		$datos->id_nivel = $request->id_nivel;
		$datos->id_grado = $request->id_grado;
		$datos->save();

		$productos = json_decode($request->lista_productos, true);

		foreach($productos as $producto){

			$datosListado = new App\ListadosProductos;
			$datosListado->id_listado = $datos->id;
			$datosListado->id_producto = $producto['id_producto'];
			$datosListado->cantidad = $producto['cantidad'] == '' ? 1 : $producto['cantidad'];
			$datosListado->save();
		}

		return back()->with('mensaje', 'Listado escolar creado');
	}

	public function listadoEliminar($id) {

		$datos = App\Listado::findOrFail($id);
		$datos->delete();

		return back()->with('mensaje', 'Listado escolar eliminado');
	}

	public function listadoEditar($id) {

		$datos = App\Listado::findOrFail($id);
		$datosProductos = App\ListadosProductos::firstOrFail()->where('id_listado', $id)->get();

		$colegios = App\Colegios::all();
		$niveles = App\Niveles::all();
		$grados = App\Grados::all();
		$productos = App\Productos::firstOrFail()->where('activo', '1')->where('imagen', '!=', '')->get();

		return view('admin.listadoeditar', compact('colegios', 'niveles', 'grados', 'productos', 'datos', 'datosProductos'));
	}

	public function listadoPutEditar(Request $request) {

		$datos = App\Listado::findOrFail($request->id);
		$datos->id_colegio = $request->id_colegio;
		$datos->id_nivel = $request->id_nivel;
		$datos->id_grado = $request->id_grado;
		$datos->save();

		$productos = json_decode($request->lista_productos, true);

		//eliminar todos los productos de esta lista
		App\ListadosProductos::firstOrFail()->where('id_listado', $datos->id)->delete(); 

		//re-ingresar productos de la lista
		foreach($productos as $producto){

			$datosListado = new App\ListadosProductos;
			$datosListado->id_listado = $datos->id;
			$datosListado->id_producto = $producto['id_producto'];
			$datosListado->cantidad = $producto['cantidad'] == '' ? 1 : $producto['cantidad'];
			$datosListado->save();
		}

		return back()->with('mensaje', 'Listado escolar actualizado');
	}

	//----------------------------------------------------------------------
	//correos
	public function correos() {

		$datos = App\Pedidos::all();

		return view('admin.correos', compact('datos'));
	}

	//----------------------------------------------------------------------
	//promociones
	public function promociones() {

		$datos = App\Promociones::findOrFail(1);
		$productos = App\Productos::firstOrFail()->where('activo', 1)->get();

		return view('admin.promociones', compact('datos', 'productos'));
	}

	public function editarPromociones(Request $request) {

		$datosEditar = App\Promociones::findOrFail(1);
		$datosEditar->productos = $request->productos == null ? '' : $request->productos;

		$datosEditar->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	//----------------------------------------------------------------------
	//blog
	public function blog() {

		$blog = App\Blog::select()->paginate(25);		

		return view('admin.blog', compact('blog'));
	}

	public function crearBlog() {	

		return view('admin.blogcrear');
	}

	public function putCrearBlog(Request $request) {	

		$blogUrl = App\Blog::select()
		->where('url', $request->url)
		->first();

		if($blogUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$blog = new App\Blog;
		$blog->url = $request->url == null ? '' : $request->url;
		$blog->titulo = $request->titulo == null ? '' : $request->titulo;
		$blog->resumen = $request->resumen == null ? '' : $request->resumen;
		$blog->texto = $request->texto == null ? '' : $request->texto;

		if($request->hasfile('imagen')) {

			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/blog/', $nombre);

		  $blog->imagen = 'images/blog/'.$nombre;
		}
		else {
			$blog->imagen = '';
		}

		$blog->save();

		return back()->with('mensaje', 'Entrada de blog creada');
	}

	public function editarBlog($id) {	

		$datos = App\Blog::select()->where('id', $id)->first();

		return view('admin.blogeditar', compact('datos'));
	}

	public function putEditarBlog(Request $request, $id) {	

		$blogUrl = App\Blog::select()
		->where('url', $request->url)
		->where('id', '<>', $id)
		->first();

		if($blogUrl) {
			return back()->withInput()->with('mensajeError', 'El url ingresado ya existe');
		}

		$blog = App\Blog::firstOrFail()->where('id', $id)->first();
		$blog->url = $request->url == null ? '' : $request->url;
		$blog->titulo = $request->titulo == null ? '' : $request->titulo;
		$blog->resumen = $request->resumen == null ? '' : $request->resumen;
		$blog->texto = $request->texto == null ? '' : $request->texto;

		if($request->hasfile('imagen')) {

			$imagen = $request->file('imagen');
			//$extension = $imagen->getClientOriginalExtension();
			$nombreOriginal = $imagen->getClientOriginalName();

			$buscar = [' '];
			$reemplazar = ['-'];

			$nombre = str_replace($buscar, $reemplazar, $nombreOriginal);

		  $imagen->move('images/blog/', $nombre);

		  $blog->imagen = 'images/blog/'.$nombre;
		}

		$blog->save();

		return back()->with('mensaje', 'Datos actualizados');
	}

	public function eliminarBlog($id) {	

		$blog = App\Blog::firstOrFail()->where('id', $id)->first();
		$blog->delete();

		return back()->with('mensaje', 'Entrada de blog eliminada');
	}

}
