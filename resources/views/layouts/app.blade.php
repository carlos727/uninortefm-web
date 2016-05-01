<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Uninorte FM Dashboard</title>
		<meta name="author" content="Carlos Beleño, Gaspar Villafañe"/>
		<meta name="description" content="Aplicación web para la administración de contenidos de la aplicación móvil Uninorte FM">
		<meta name="keywords" content="uninorte emisora">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.css') }}"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/screen.css') }}"  media="screen,projection"/>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<div class="row">
			<aside>
				<ul class="side-nav fixed col l2 m3">
					<header class="center">
						<div>
							<a id="logo" href="{{ URL::to('/') }}"><img src="{{ URL::asset('img/logo.png') }}" alt="Logo Uninorte FM"></a>
						</div>
						<div class="row">
							<div class="col s6"><p>Usuario</p></div>
							<div class="col s4">
								<a class='dropdown-button' href='#' data-activates='dropdown1'>
									<i class="material-icons">arrow_drop_down</i>
								</a>
								<ul id='dropdown1' class='dropdown-content'>
									<li><a href="#!">Salir</a></li>
								</ul>
							</div>
						</div>
					</header>
					<li class="{{ $class['users'] }}">
						<i class="material-icons">supervisor_account</i>
						{{ link_to('/users', 'Usuarios', ['class' => 'nav-link']) }}
					</li>
					<li class="{{ $class['programs'] }}">
						<i class="material-icons">playlist_play</i>
						{{ link_to('/', 'Programación', ['class' => 'nav-link']) }}
				</ul>
			</aside>

			<section class="col l10 offset-l2 m9 offset-m3">
				@yield('content')
			</section>
		</div>

		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="{{ URL::asset('js/bin/materialize.min.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				$('.modal-trigger').leanModal();
				$('.tooltipped').tooltip({delay: 50});
			});
		</script>
	</body>
</html>