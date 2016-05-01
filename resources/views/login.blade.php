<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Login | Dashboard Uninorte FM</title>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
		<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/login.css') }}"  media="screen,projection"/>	
	</head>

	<body class="red-inst">
		<div id="login-page" class="row">
			<div class="col s12 z-depth-6 card-panel">
				<form class="login-form">
					<div class="row">
						<div class="input-field col s12 center">
							<img src="{{ URL::asset('img/logo.png') }}" alt="Logo Uninorte FM" class="responsive-img valign profile-image-login">
							<p class="center login-form-text"><b>Uninorte F.M. Estereo | Dashboard</b></p>
						</div>
					</div>
					<div class="row margin">
						<div class="input-field col s12">
							<i class="mdi-social-person-outline prefix"></i>
							<input class="validate" id="username" type="text" name="username">
							<label for="username" data-error="wrong" data-success="right" class="center-align">Nombre de Usuario</label>
						</div>
					</div>
					<div class="row margin">
						<div class="input-field col s12">
							<i class="mdi-action-lock-outline prefix"></i>
							<input id="password" type="password" name="password">
							<label for="password">Contraseña</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<a href="{{ URL::to('/') }}" class="btn waves-effect waves-light col s12">Ingresar</a>
						</div>
					</div>
				</form>
			</div>
		</div>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
	</body>
</html>