<?php

//web
Route::get('/test', 'AdminController@test')->name('test');

Route::get('/', 'WebController@inicio')->name('inicio');
Route::get('/productos', 'WebController@productos')->name('productos');
Route::get('/productos/{url}', 'WebController@categoria')->name('productos.categoria');
Route::get('/producto/{url}', 'WebController@producto')->name('producto');
Route::get('/filosofia', 'WebController@filosofia')->name('filosofia');
Route::get('/blog', 'WebController@blog')->name('blog');
Route::get('/blog/{url}', 'WebController@blogDetalle')->name('blog.detalle');

Route::get('/contacto', 'WebController@contacto')->name('contacto');
Route::put('/contacto', 'WebController@contactoEnviar')->name('contacto.enviar');
Route::get('/contacto/gracias', 'WebController@contactoGracias')->name('contacto.gracias');

Route::get('/buscar', 'WebController@buscar')->name('buscar');

/*Route::get('/familias/{url}', 'WebController@categorias')->name('categorias');
Route::get('/familias/{categoria}/{url}', 'WebController@grupos')->name('grupos');
Route::get('/productos', 'WebController@producto')->name('productos');
Route::get('/producto/{url}', 'WebController@producto')->name('producto');

Route::get('/nosotros', 'WebController@nosotros')->name('nosotros');
Route::get('/politicas-y-terminos', 'WebController@politicas')->name('politicas');

Route::get('/listado-escolar', 'WebController@listadoEscolar')->name('listado');
Route::get('/listado-escolar/niveles', 'WebController@getNiveles')->name('get.niveles');
Route::get('/listado-escolar/grados', 'WebController@getGrados')->name('get.grados');
Route::get('/listado-escolar/listado', 'WebController@getListado')->name('get.listado');
Route::get('/listado-escolar/add-listado', 'WebController@addListado')->name('add.listado');
*/

//carrito
Route::get('/carrito', 'WebController@carrito')->name('carrito');
Route::get('/carrito/conteo', 'WebController@getCarritoConteo')->name('carrito.conteo');
Route::put('/carrito/add', 'WebController@carritoAdd')->name('carrito.add');
Route::get('/carrito/get', 'WebController@getCarrito')->name('carrito.get');
Route::get('/carrito/update', 'WebController@carritoUpdate')->name('carrito.update');
Route::get('/carrito/delete', 'WebController@carritoDelete')->name('carrito.delete');
Route::get('/carrito/total', 'WebController@getCarritoTotal')->name('carrito.total');
Route::get('/carrito/tabla', 'WebController@getCarritoTabla')->name('carrito.tabla');


//facturacion
Route::get('/facturacion', 'WebController@facturacion')->name('facturacion');
Route::put('/facturacion', 'WebController@crearPedido')->name('pedido.crear');
Route::get('/culqi', 'WebController@pagoCulqi')->name('culqi');
Route::get('/gracias', 'WebController@gracias')->name('gracias');
Route::get('/gracias-invitado', 'WebController@graciasInvitado')->name('gracias.invitado');

Route::get('/provincias', 'WebController@getProvincias')->name('provincias');
Route::get('/distritos', 'WebController@getDistritos')->name('distritos');

//--------------------------------------------------------------------------------------------
//clientes
Route::get('/login', 'WebController@login')->name('clientes.login');

Route::post('/login', 'WebController@postLogin')->name('clientes.postLogin');
Route::get('/logout', 'WebController@logout')->name('clientes.logout');

Route::post('/registro', 'WebController@postRegistro')->name('clientes.registro');
Route::post('/password', 'WebController@cambiarPassword')->name('clientes.password');

Route::get('/perfil', 'WebController@perfil')->name('clientes.perfil');
Route::post('/perfil', 'WebController@postPerfil')->name('clientes.postPerfil');

Route::get('/mis-pedidos', 'WebController@misPedidos')->name('clientes.pedidos');
Route::get('/mis-pedidos/{id}', 'WebController@miPedido')->name('clientes.pedido');
Route::put('/mis-pedidos/{id}', 'WebController@subirVoucher')->name('clientes.pedido');

Route::get('/password-reset', 'WebController@passwordReset')->name('cliente.password.reset');
Route::put('/password-reset', 'WebController@putPasswordReset')->name('cliente.password.reset');
Route::get('/password/reset', 'WebController@resetPassword')->name('cliente.resetPassword');
Route::put('/password/reset', 'WebController@putResetPassword')->name('cliente.putResetPassword');

//--------------------------------------------------------------------------------------------
//admin
Route::get('/admin', 'AdminController@getLogin')->name('login');
Route::post('/admin/login', 'AdminController@postLogin')->name('postLogin');
Route::get('/admin/logout', 'AdminController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/admin/inicio', 'AdminController@inicio')->name('admin.inicio');

	Route::get('/admin/configuraciones', 'AdminController@configuraciones')->name('admin.configuraciones');
	Route::put('/admin/configuraciones', 'AdminController@editarConfiguraciones')->name('admin.configuraciones.editar');

	Route::get('/admin/contacto', 'AdminController@contacto')->name('admin.contacto');
	Route::put('/admin/contacto', 'AdminController@editarContacto')->name('admin.contacto.editar');

	Route::get('/admin/filosofia', 'AdminController@filosofia')->name('admin.filosofia');
	Route::put('/admin/filosofia', 'AdminController@editarFilosofia')->name('admin.filosofia.editar');
	Route::get('/admin/entradas', 'AdminController@entradas')->name('admin.entradas');
	Route::get('/admin/entradas/crear', 'AdminController@crearEntrada')->name('admin.entradas.crear');
	Route::put('/admin/entradas/crear', 'AdminController@putCrearEntrada')->name('admin.entradas.crear');
	Route::get('/admin/entradas/editar/{id}', 'AdminController@editarEntrada')->name('admin.entradas.editar');
	Route::put('/admin/entradas/editar/{id}', 'AdminController@putEditarEntrada')->name('admin.entradas.editar');
	Route::get('/admin/entradas/eliminar/{id}', 'AdminController@eliminarEntrada')->name('admin.entradas.eliminar');

	Route::get('/admin/portada', 'AdminController@portada')->name('admin.portada');
	Route::put('/admin/portada', 'AdminController@editarPortada')->name('admin.portada.editar');


	Route::get('/admin/nosotros', 'AdminController@nosotros')->name('admin.nosotros');
	Route::put('/admin/nosotros', 'AdminController@editarNosotros')->name('admin.nosotros.editar');

	Route::get('/admin/politicas', 'AdminController@politicas')->name('admin.politicas');
	Route::put('/admin/politicas', 'AdminController@editarPoliticas')->name('admin.politicas.editar');

	Route::get('/admin/promociones', 'AdminController@promociones')->name('admin.promociones');
	Route::put('/admin/promociones', 'AdminController@editarPromociones')->name('admin.promociones.editar');

	//--------------------------------------------------------------------------------------------
	//productos
	Route::get('/admin/productos', 'AdminController@productos')->name('admin.productos');
	Route::get('/admin/productos/actualizar', 'AdminController@actualizarProductos')->name('admin.productos.actualizar');

	Route::get('/admin/producto/{id}', 'AdminController@producto')->name('admin.producto');
	Route::put('/admin/producto/{id}', 'AdminController@editarProducto')->name('admin.producto.editar');
	Route::post('/admin/imagen/{id}', 'AdminController@subirImagen')->name('admin.producto.imagen');
	Route::get('/admin/imagen/eliminar/{id}', 'AdminController@eliminarImagen')->name('admin.producto.imagen.eliminar');
	Route::get('/admin/imagen/ordenar', 'AdminController@ordenarImagenes')->name('admin.producto.imagen.ordenar');

	//--------------------------------------------------------------------------------------------
	//tarifario
	Route::get('/admin/tarifario', 'AdminController@tarifario')->name('admin.tarifario');
	Route::get('/admin/tarifario/editar', 'AdminController@editarTarifario')->name('admin.tarifario.editar');

	//--------------------------------------------------------------------------------------------
	//categorias
	Route::get('/admin/categorias', 'AdminController@categorias')->name('admin.categorias');
	Route::get('/admin/categorias/crear', 'AdminController@crearCategoria')->name('admin.categorias.crear');
	Route::put('/admin/categorias/crear', 'AdminController@putCrearCategoria')->name('admin.categorias.crear');
	Route::get('/admin/categorias/editar/{id}', 'AdminController@editarCategoria')->name('admin.categorias.editar');
	Route::put('/admin/categorias/editar/{id}', 'AdminController@putEditarCategoria')->name('admin.categorias.editar');
	Route::get('/admin/categorias/eliminar/{id}', 'AdminController@eliminarCategoria')->name('admin.categorias.eliminar');
	Route::get('/admin/categorias/ordenar', 'AdminController@ordenarCategorias')->name('admin.categorias.ordenar');

	//--------------------------------------------------------------------------------------------
	//grados
	Route::get('/admin/grados', 'AdminController@grados')->name('admin.grados');
	Route::get('/admin/grados/crear', 'AdminController@crearGrado')->name('admin.grados.crear');
	Route::put('/admin/grados/crear', 'AdminController@putCrearGrado')->name('admin.grados.crear');
	Route::get('/admin/grados/editar/{id}', 'AdminController@editarGrado')->name('admin.grados.editar');
	Route::put('/admin/grados/editar/{id}', 'AdminController@putEditarGrado')->name('admin.grados.editar');
	Route::get('/admin/grados/eliminar/{id}', 'AdminController@eliminarGrado')->name('admin.grados.eliminar');
	Route::get('/admin/grados/ordenar', 'AdminController@ordenarGrados')->name('admin.grados.ordenar');

	//--------------------------------------------------------------------------------------------
	//blog
	Route::get('/admin/blog', 'AdminController@blog')->name('admin.blog');
	Route::get('/admin/blog/crear', 'AdminController@crearBlog')->name('admin.blog.crear');
	Route::put('/admin/blog/crear', 'AdminController@putCrearBlog')->name('admin.blog.crear');
	Route::get('/admin/blog/editar/{id}', 'AdminController@editarBlog')->name('admin.blog.editar');
	Route::put('/admin/blog/editar/{id}', 'AdminController@putEditarBlog')->name('admin.blog.editar');
	Route::get('/admin/blog/eliminar/{id}', 'AdminController@eliminarBlog')->name('admin.blog.eliminar');

	//--------------------------------------------------------------------------------------------
	//familias
	Route::get('/admin/familias', 'AdminController@familias')->name('admin.familias');
	Route::get('/admin/familias/actualizar', 'AdminController@actualizarFamilias')->name('admin.familias.actualizar');
	Route::get('/admin/familia/{id}', 'AdminController@familia')->name('admin.familia');
	Route::put('/admin/familia/{id}', 'AdminController@editarFamilia')->name('admin.familia.editar');

	//--------------------------------------------------------------------------------------------
	//sub-familias
	Route::get('/admin/subfamilias', 'AdminController@subfamilias')->name('admin.subfamilias');
	Route::get('/admin/subfamilias/actualizar', 'AdminController@actualizarSubfamilias')->name('admin.subfamilias.actualizar');
	Route::get('/admin/subfamilia/{id}', 'AdminController@subfamilia')->name('admin.subfamilia');
	Route::put('/admin/subfamilia/{id}', 'AdminController@editarSubfamilia')->name('admin.subfamilia.editar');

	//--------------------------------------------------------------------------------------------
	//grupos
	Route::get('/admin/grupos', 'AdminController@grupos')->name('admin.grupos');
	Route::get('/admin/grupos/actualizar', 'AdminController@actualizarGrupos')->name('admin.grupos.actualizar');
	Route::get('/admin/grupo/{id}', 'AdminController@grupo')->name('admin.grupo');
	Route::put('/admin/grupo/{id}', 'AdminController@editarGrupo')->name('admin.grupo.editar');

	//--------------------------------------------------------------------------------------------
	Route::get('/admin/pedidos', 'AdminController@pedidos')->name('admin.pedidos');
	Route::get('/admin/pedidos/{id}', 'AdminController@pedido')->name('admin.pedido');
	Route::put('/admin/rechazar-voucher/{id}', 'AdminController@rechazarVoucher')->name('admin.voucher.rechazar');
	Route::get('/admin/estado', 'AdminController@cambiarEstado')->name('admin.pedidos.estado');
	//Route::get('/admin/pedidos/datos', 'AdminController@getPedido')->name('admin.pedidos.datos');
	//Route::get('/admin/pedidos/detalle', 'AdminController@getDetalle')->name('admin.pedidos.detalle');

	Route::get('/admin/clientes', 'AdminController@clientes')->name('admin.clientes');
	Route::get('/admin/cliente/{id}', 'AdminController@cliente')->name('admin.cliente');
	Route::put('/admin/cliente/{id}', 'AdminController@editarCliente')->name('admin.cliente.editar');

	Route::get('/admin/slider', 'AdminController@slider')->name('admin.slider');
	Route::get('/admin/slider-crear', 'AdminController@sliderCrear')->name('admin.slider.crear');
	Route::put('/admin/slider-crear', 'AdminController@sliderPutCrear')->name('admin.slider.crear');
	Route::get('/admin/slider-eliminar/{id}', 'AdminController@sliderEliminar')->name('admin.slider.eliminar');
	Route::get('/admin/slider-editar/{id}', 'AdminController@sliderEditar')->name('admin.slider.editar');
	Route::put('/admin/slider-editar/{id}', 'AdminController@sliderPutEditar')->name('admin.slider.editar');

	Route::get('/admin/colegios', 'AdminController@colegios')->name('admin.colegios');
	Route::get('/admin/colegios-crear', 'AdminController@colegiosCrear')->name('admin.colegios.crear');
	Route::put('/admin/colegios-crear', 'AdminController@colegiosPutCrear')->name('admin.colegios.crear');
	Route::get('/admin/colegios-eliminar/{id}', 'AdminController@colegiosEliminar')->name('admin.colegios.eliminar');
	Route::get('/admin/colegios-editar/{id}', 'AdminController@colegiosEditar')->name('admin.colegios.editar');
	Route::put('/admin/colegios-editar/{id}', 'AdminController@colegiosPutEditar')->name('admin.colegios.editar');

	Route::get('/admin/niveles', 'AdminController@niveles')->name('admin.niveles');
	Route::get('/admin/niveles-crear', 'AdminController@nivelesCrear')->name('admin.niveles.crear');
	Route::put('/admin/niveles-crear', 'AdminController@nivelesPutCrear')->name('admin.niveles.crear');
	Route::get('/admin/niveles-eliminar/{id}', 'AdminController@nivelesEliminar')->name('admin.niveles.eliminar');
	Route::get('/admin/niveles-editar/{id}', 'AdminController@nivelesEditar')->name('admin.niveles.editar');
	Route::put('/admin/niveles-editar/{id}', 'AdminController@nivelesPutEditar')->name('admin.niveles.editar');
	Route::get('/admin/niveles/ordenar', 'AdminController@ordenarNiveles')->name('admin.niveles.ordenar');

	/*Route::get('/admin/grados', 'AdminController@grados')->name('admin.grados');
	Route::get('/admin/grados-crear', 'AdminController@gradosCrear')->name('admin.grados.crear');
	Route::put('/admin/grados-crear', 'AdminController@gradosPutCrear')->name('admin.grados.crear');
	Route::get('/admin/grados-eliminar/{id}', 'AdminController@gradosEliminar')->name('admin.grados.eliminar');
	Route::get('/admin/grados-editar/{id}', 'AdminController@gradosEditar')->name('admin.grados.editar');
	Route::put('/admin/grados-editar/{id}', 'AdminController@gradosPutEditar')->name('admin.grados.editar');*/

	Route::get('/admin/listado', 'AdminController@listado')->name('admin.listado');
	Route::get('/admin/listado-crear', 'AdminController@listadoCrear')->name('admin.listado.crear');
	Route::put('/admin/listado-crear', 'AdminController@listadoPutCrear')->name('admin.listado.crear');
	Route::get('/admin/listado-eliminar/{id}', 'AdminController@listadoEliminar')->name('admin.listado.eliminar');
	Route::get('/admin/listado-editar/{id}', 'AdminController@listadoEditar')->name('admin.listado.editar');
	Route::put('/admin/listado-editar/{id}', 'AdminController@listadoPutEditar')->name('admin.listado.editar');

	Route::get('/admin/correos', 'AdminController@correos')->name('admin.correos');
   
});