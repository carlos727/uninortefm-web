@extends('layouts.app')

@section('content')

	<header id="headuser">
		<div class="row">
			<h2 class="center">Gestor de Usuarios Uninorte FM</h2>
			<div class="divider"></div>
		</div>
	</header>

	<div class="row center">
		<a class="waves-effect waves-light btn modal-trigger" href="#modal-user">Nuevo Usuario</a>
		<div id="modal-user" class="modal">
			<div class="modal-content">
				<h4>Nuevo Usuario</h4>
				<div class="row">
					<form action="{{ url('users/user') }}" method="POST"  class="col s12">
						{!! csrf_field() !!}
						<div class="row">
							<div class="input-field col s10 offset-s1">
								<i class="material-icons prefix">account_circle</i>
								<input id="icon_prefix" type="text" name="username">
								<label for="icon_prefix">Nombre de usuario</label>
							</div>
						</div>
						<div class="row dv-rol">
							<label for="rol">Rol del Usuario</label>
							<div id="rol" class="col s10 offset-s1">
								<select name="rol">
									<option value="" disabled selected>Seleccione un rol</option>
									<option value="admin">Usuario DTIC</option>
									<option value="emisora">Usuario Emisora</option>
								</select>
							</div>
						</div>
						<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Habilitar</button>
					</form>
				</div>
			</div>
		</div>
		@include('common.errors')
	</div>

	@if (count($users) > 0)
		<section class="row">
			<?php $a=0 ?>
			@foreach ($users as $user)
				@if ($user->isActive == true)
					<?php $a++; ?>
				@endif
			@endforeach

			<?php if ($a > 0) { ?>
				<div class="col l5 m12">
					<table class="striped">
						<thead>
							<tr><th>HABILITADOS</th></tr>
							<tr>
								<th data-field="username">Usuario</th>
								<th data-field="rol">Rol</th>
								<th data-field="actions">Acciones</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($users as $user)
								@if ($user->isActive == true)
									<tr>
										<td><div>{{ $user->username }}</div></td>
										<td>
											<div>
												@if ($user->rol == 'admin')
													DTIC
												@else
													Emisora
												@endif
											</div>
										</td>
										<td>
											<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modet{{ $user->id }}" data-position="left" data-delay="50" data-tooltip="Inhabilitar"><i class="material-icons">lock_outline</i></a>
											<div id="modet{{ $user->id }}" class="modal">
												<div class="modal-content center">
													<h4 class="center">Inhabilitar Usuario</h4>
													<div class="row">
														<form class="col s12" action="{{ url('users/user/'.$user->id) }}" method="POST">
															{!! csrf_field() !!}
															{!! method_field('PUT') !!}
															<div class="row">
																<div class="col s4 center"><img src="{{ URL::asset('img/Lock-Outline.png') }}" alt=""></div>
																<div id="del-cont" class="col s8">
																	<p><b>¿Estas seguro de inhabilitar este usuario?</b></p>
																	<p>Nombre: {{ $user->username }}</p>
																	<p>Rol: 
																		@if ($user->rol == 'admin')
																			Usuario DTIC
																		@else
																			Usuario Emisora
																		@endif
																	</p>
																</div>
															</div>
															<input type="text" name="username" value="{{ $user->username }}" class="hide">
															<input type="text" name="rol" value="{{ $user->rol }}" class="hide">
															<input type="text" name="isActive" value="false" class="hide">
															<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Inhabilitar</button>
														</form>
													</div>
												</div>
											</div>
											<a id="btndlt"  class="waves-effect waves-light btn modal-trigger tooltipped" href="#model{{ $user->id }}" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></a>
											<div id="model{{ $user->id }}" class="modal">
												<div class="modal-content">
													<h4 class="center">Eliminar Usuario</h4>
													<div class="row">
														<div class="col s4 center"><img src="{{ URL::asset('img/Icon-warning.png') }}" alt=""></div>
														<div id="del-cont" class="col s8">
															<p><b>¿Estas seguro de descartar este usuario?</b></p>
															<p>Nombre: {{ $user->username }}</p>
															<p>Rol: 
																@if ($user->rol == 'admin')
																	Usuario DTIC
																@else
																	Usuario Emisora
																@endif
															</p>
														</div>
													</div>
													<form action="{{ url('users/user/'.$user->id) }}" method="POST" class="center">
														{!! csrf_field() !!}
														{!! method_field('DELETE') !!}
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Eliminar</button>
													</form>
												</div>
											</div>
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			<?php } ?>

			<?php $a=0 ?>
			@foreach ($users as $user)
				@if ($user->isActive == false)
					<?php $a++; ?>
				@endif
			@endforeach

			<?php if ($a > 0) { ?>
				<div class="col l5 offset-l1 m12 offset-m0">
					<table class="striped">
						<thead>
							<tr><th>INHABILITADOS</th></tr>
							<tr>
								<th data-field="username">Usuario</th>
								<th data-field="rol">Rol</th>
								<th data-field="actions">Acciones</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($users as $user)
								@if ($user->isActive == false)
									<tr>
										<td><div>{{ $user->username }}</div></td>
										<td>
											<div>
												@if ($user->rol == 'admin')
													DTIC
												@else
													Emisora
												@endif
											</div>
										</td>
										<td>
											<a class="waves-effect waves-light btn modal-trigger tooltipped" href="#modeti{{ $user->id }}" data-position="left" data-delay="50" data-tooltip="Habilitar"><i class="material-icons">lock_open</i></a>
											<div id="modeti{{ $user->id }}" class="modal">
												<div class="modal-content center">
													<h4 class="center">Habilitar Usuario</h4>
													<div class="row">
														<form class="col s12" action="{{ url('users/user/'.$user->id) }}" method="POST">
															{!! csrf_field() !!}
															{!! method_field('PUT') !!}
															<div class="row">
																<div class="col s4 center"><img src="{{ URL::asset('img/open-lock.png') }}" alt=""></div>
																<div id="del-cont" class="col s8">
																	<p><b>¿Estas seguro de habilitar este usuario?</b></p>
																	<p>Nombre: {{ $user->username }}</p>
																	<p>Rol: 
																		@if ($user->rol == 'admin')
																			Usuario DTIC
																		@else
																			Usuario Emisora
																		@endif
																	</p>
																</div>
															</div>
															<input type="text" name="username" value="{{ $user->username }}" class="hide">
															<input type="text" name="rol" value="{{ $user->rol }}" class="hide">
															<input type="text" name="isActive" value="true" class="hide">
															<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Habilitar</button>
														</form>
													</div>
												</div>
											</div>
											<a id="btndlt"  class="waves-effect waves-light btn modal-trigger tooltipped" href="#modeli{{ $user->id }}" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></a>
											<div id="modeli{{ $user->id }}" class="modal">
												<div class="modal-content">
													<h4 class="center">Eliminar Usuario</h4>
													<div class="row">
														<div class="col s4 center"><img src="{{ URL::asset('img/Icon-warning.png') }}" alt=""></div>
														<div id="del-cont" class="col s8">
															<p><b>¿Estas seguro de descartar este usuario?</b></p>
															<p>Nombre: {{ $user->username }}</p>
															<p>Rol: 
																@if ($user->rol == 'admin')
																	Usuario DTIC
																@else
																	Usuario Emisora
																@endif
															</p>
														</div>
													</div>
													<form action="{{ url('users/user/'.$user->id) }}" method="POST" class="center">
														{!! csrf_field() !!}
														{!! method_field('DELETE') !!}
														<button type="submit" class="btn modal-action modal-close waves-effect waves-green">Eliminar</button>
													</form>
												</div>
											</div>
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			<?php } ?>
		</section>
	@endif

@endsection