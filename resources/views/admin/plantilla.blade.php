<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="icon" href="{{ asset('assets_admin/img/icono.png') }}" type="image/ico" />

  <title>Administraci&oacute;n</title>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Bootstrap -->
  <link href="{{ asset('assets_admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('assets_admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('assets_admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ asset('assets_admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="{{ asset('assets_admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{ asset('assets_admin/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="{{ asset('assets_admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

  <link href="{{ asset('assets_admin/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('assets_admin/build/css/custom.css?v=1.1') }}" rel="stylesheet">

  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}">

  <link href="{{ asset('assets_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets_admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets_admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets_admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">

          <div class="navbar nav_title logo-md" style="border: 0;">
            <a href="{{ route('admin.inicio') }}" class="site_title">
              <img src="{{ asset('assets_admin/img/logo.png') }}" class="img-fluid">
            </a>
          </div>

          <div class="navbar nav_title logo-sm" style="border: 0;">
            <a href="{{ route('admin.inicio') }}" class="site_title">
              <img src="{{ asset('assets_admin/img/logo_mini.png') }}" class="img-fluid">
            </a>
          </div>

          <div class="clearfix"></div>

          <br>

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Menu Principal</h3>
              <ul class="nav side-menu">
                <li><a href="{{ route('admin.configuraciones') }}"><i class="fa fa-cog"></i> Configuraciones</a></li>
                <li><a href="{{ route('admin.portada') }}"><i class="fa fa-home"></i> Portada</a></li>

                <li><a><i class="fa fa-cubes"></i> Productos <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('admin.productos') }}">Administrar Productos</a></li>
                    <li><a href="{{ route('admin.categorias') }}">Categorias</a></li>
                    <li><a href="{{ route('admin.niveles') }}">Niveles</a></li>
                    <li><a href="{{ route('admin.grados') }}">Grados</a></li>
                    <!--
                    <li><a href="{{ route('admin.subfamilias') }}">Sub-Familias</a></li>
                    <li><a href="{{ route('admin.grupos') }}">Grupos</a></li>    -->            
                  </ul>
                </li>

                <li><a href="{{ route('admin.tarifario') }}"><i class="fa fa-truck"></i> Tarifario Delivery</a></li>

                <!--
                <li><a><i class="fa fa-list-alt"></i> Listado Escolar <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('admin.listado') }}">Listado Escolar</a></li>
                    <li><a href="{{ route('admin.colegios') }}">Colegios</a></li>
                    <li><a href="{{ route('admin.niveles') }}">Niveles</a></li>
                    <li><a href="{{ route('admin.grados') }}">Grados</a></li>
                  </ul>
                </li>-->

                <li><a href="{{ route('admin.pedidos') }}"><i class="fa fa-edit"></i> Pedidos</a></li>
                <li><a href="{{ route('admin.clientes') }}"><i class="fa fa-users"></i> Clientes</a></li>
                <!--<li><a href="{{ route('admin.correos') }}"><i class="fa fa-envelope"></i> Correos</a></li>-->
                <li><a href="{{ route('admin.blog') }}"><i class="fa fa-file-text-o"></i> Blog</a></li>
                <li><a><i class="fa fa-cube"></i> Filosofia <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('admin.filosofia') }}">Textos</a></li>
                    <li><a href="{{ route('admin.entradas') }}">Sobre nosotros</a></li>  
                  </ul>
                </li>
                <li><a href="{{ route('admin.contacto') }}"><i class="fa fa-cube"></i> Contacto</a></li>
                
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  Bienvenido: {{ Auth::user()->usuario }}
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item"  href="#"> Cambiar Contraseña</a>
                  <a class="dropdown-item"  href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        
        @yield('contenido')

      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
           Diseñado y programado por <a href="http://www.xcrivas.com/" target="_blank">XCrivas Comunicaciones</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  @yield('loader')

  <!-- jQuery -->
  <script src="{{ asset('assets_admin/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('assets_admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('assets_admin/vendors/fastclick/lib/fastclick.js') }}"></script>
  <!-- NProgress -->
  <script src="{{ asset('assets_admin/vendors/nprogress/nprogress.js') }}"></script>
  <!-- Chart.js -->
  <script src="{{ asset('assets_admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
  <!-- gauge.js -->
  <script src="{{ asset('assets_admin/vendors/gauge.js/dist/gauge.min.js') }}"></script>
  <!-- bootstrap-progressbar -->
  <script src="{{ asset('assets_admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('assets_admin/vendors/iCheck/icheck.min.js') }}"></script>
  <!-- Skycons -->
  <script src="{{ asset('assets_admin/vendors/skycons/skycons.js') }}"></script>
  <!-- Flot -->
  <script src="{{ asset('assets_admin/vendors/Flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/Flot/jquery.flot.pie.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/Flot/jquery.flot.time.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/Flot/jquery.flot.stack.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/Flot/jquery.flot.resize.js') }}"></script>
  <!-- Flot plugins -->
  <script src="{{ asset('assets_admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/flot.curvedlines/curvedLines.js') }}"></script>
  <!-- DateJS -->
  <script src="{{ asset('assets_admin/vendors/DateJS/build/date.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('assets_admin/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{ asset('assets_admin/vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

  <!-- Datatables -->
  <script src="{{ asset('assets_admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/jszip/dist/jszip.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{ asset('assets_admin/build/js/custom.min.js') }}"></script>

  <!-- CKeditor -->
  <script src="{{ asset('assets_admin/ckeditor/ckeditor.js') }}"></script>

  <!-- autosize -->
  <script src="{{ asset('assets_admin/autosize/autosize.min.js') }}"></script>

  <!-- Switchery -->
  <script src="{{ asset('assets_admin/vendors/switchery/dist/switchery.min.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $('.alert').alert();

      $('.alert').delay(4000).slideUp(200, function() {
        $(this).alert('close');
      });
    });
  </script>

  @yield('script')

</body>
</html>
