<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Administraci&oacute;n
	</title>
	<!-- Bootstrap -->
	<link href="assets_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="assets_admin/vendors/font-awesome/css/font-awesome.min.css"rel="stylesheet">
	<!-- NProgress -->
	<link href="assets_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Animate.css -->
	<link href="assets_admin/vendors/animate.css/animate.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="assets_admin/build/css/custom.css" rel="stylesheet">
</head>

<body class="login">
	<div>
		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form autocomplete="off" method="POST" action="{{ route('postLogin') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input autocomplete="false" name="hidden" type="text" style="display:none;">
						<h1>
							<img src="assets_admin/img/logo.png" class="img-responsive logo" alt="XCrivas">
						</h1>
						@if (session('mensaje'))
						<div class="alert alert-danger alert-dismissible fade show text-left"
						role="alert">
							{{ session('mensaje') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">
									&times;
								</span>
							</button>
						</div>
						@endif
						<div class="item input-group">
							<span class="input-group-addon">
								<i class="fa fa-user" aria-hidden="true">
								</i>
							</span>
							<input type="text" class="form-control" placeholder="Usuario" name="usuario"
							autocomplete="off" value="{{ old('usuario') }}" required>
						</div>
						<div class="item input-group">
							<span class="input-group-addon">
								<i class="fa fa-lock" aria-hidden="true">
								</i>
							</span>
							<input type="password" class="form-control" placeholder="Password" name="password"
							autocomplete="new-password" value="{{ old('password') }}" required>
						</div>
						<div class="input-group div-boton">
							<span id="mensaje">
							</span>
							<button type="submit" id="ingresar" class="btn btn-success">
								Ingresar
								<i class="fa fa-sign-in" aria-hidden="true">
								</i>
							</button>
						</div>
						<div class="clearfix">
						</div>
						<div class="separator">
							<div class="clearfix">
							</div>
							<br />
							<div>
								<p>
									©2020 Todos los derechos reservados. Diseñado y programado por
									<a href="https://www.xcrivas.com/" target="_blank">XCrivas Comunicaciones</a>
								</p>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="assets_admin/vendors/jquery/dist/jquery.min.js">
	</script>
	<!-- Bootstrap -->
	<script src="assets_admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js">
	</script>
	<!-- Custom Theme Scripts -->
	<script src="assets_admin/build/js/custom.min.js">
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.alert').alert();

			$('.alert').delay(4000).slideUp(200, function() {
        $(this).alert('close');
      });
		});
	</script>
</body>
</html>