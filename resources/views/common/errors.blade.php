@if (count($errors) > 0)
	<!-- Form Error List -->
	<div class="row">
		<div class="alert z-depth-2 chip col s6 offset-s3">
			<ul class="col s11">
				<h5><b>¡Lo sentimos! ¡Algo salió mal!</b></h5>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			<i class="material-icons col s1">close</i>
		</div>
	</div>
@endif