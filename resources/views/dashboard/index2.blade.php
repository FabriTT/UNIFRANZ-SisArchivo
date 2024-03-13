<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('dashboard/img/icons/icon-48x48.png') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<title>Dashboard CG</title>

	<link href="{{ asset('dashboard/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('propio/css/estilos.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">Cementerio General</span>
				</a>

				<ul class="sidebar-nav">

					<li class="sidebar-header">
						Servicios
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link"  href="{{ route('actasCliente',$id)}}">
							<i class="fas fa-solid fa-book"></i><span
								class="align-middle">Actas</span>
						</a>
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link" href="{{ route('alquileresCliente',$id)}}">
							<i class="fas fa-cross"></i><span
								class="align-middle">Alquiler de nichos</span>
						</a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="#" style="display:none">
							<i class="fas fa-solid fa-church"></i><span
								class="align-middle">Misas</span>
						</a>
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link" href="#" style="display:none">
							<i class="fas fa-solid fa-truck"></i><span
								class="align-middle">Traslados</span>
						</a>
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link" href="#" style="display:none">
							<i class="fas fa-solid fa-fire"></i><span
								class="align-middle">Cremaciones</span>
						</a>
					</li>
					<li class="sidebar-item active">
						<a class="sidebar-link" href="#" style="display:none">
							<i class="fas fa-solid fa-seedling"></i><span
								class="align-middle">Renovaciones</span>
						</a>
					</li>
					
				</ul>


			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
								data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							@php 
							$usuario = app()->call('App\Http\Controllers\UserController@buscar', ['id' => $id]);
							@endphp
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							<img src="{{ asset('dashboard/img/avatars/'.$usuario[0]->imagen) }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
							<span class="text-dark" style="margin-right:">
							{{ $usuario[0]->name}} {{ $usuario[0]->paterno }}
							</span>
							</a>


							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="fas fa-regular fa-user"></i> Profile</a>
								@if(count($usuario)>=1)
								<a class="dropdown-item" href="{{ route('dashemp',$id) }}"><i class="fas fa-solid fa-briefcase"></i> Trabajo</a>
								@endif
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('inicio') }} ">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				@yield('content')
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>Fsociaty</strong></a> - <a
									class="text-muted" href="#" target="_blank"><strong>Copyright &copy; 2023
										Unifranz</strong></a>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Soporte</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Centro de ayuda</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Privacidad</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Terminos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<label id="oculto" style="display:none">{{ $usuario[0]->id_car }}</label>
	<script src="{{ asset('dashboard/js/app.js') }}"></script>
	<script src="{{ asset('propio/js/prueba.js') }}"></script>
	<script src="{{ asset('propio/js/dashboard.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>