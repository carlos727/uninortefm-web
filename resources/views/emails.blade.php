@extends('layouts.app')

@section('content')

	<header id="heademail">
		<div class="row">
			<h2 class="center">Buzón de Sugerencias</h2>
			<div class="divider"></div>
		</div>
	</header>

	@if (count($emails) > 0)
		<section class="row">
			<?php $a=0 ?>
			@foreach ($emails as $email)
				@if ($email->isChecked == false)
					<?php $a++; ?>
				@endif
			@endforeach

			<?php if ($a > 0) { ?>
				<ul class="collapsible" data-collapsible="accordion">
					No Leídos
					@foreach ($emails as $email)
						@if ($email->isChecked == false)
							<li>
								<div class="collapsible-header">
									<i class="material-icons">mail</i>
									<p><b>{{ $email->sender_name }}	{{ $email->subject }} </b><span class="truncate">- {{ $email->message }}</span></p>
								</div>
								<div class="collapsible-body">
									<section>{{ $email->message }}</section>
									<div class="divider"></div>
									<footer>
										<form action="{{ url('emails/email/'.$email->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											<input type="text" name="isChecked" value="true" class="hide">
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="left" data-delay="50" data-tooltip="Marcar como Leído"><i class="material-icons">mail_outline</i></button>
										</form>

										<form action="{{ url('emails/email/'.$email->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</footer>
								</div>
							</li>
						@endif
					@endforeach
				</ul>
			<?php } ?>

			<?php $a=0 ?>
			@foreach ($emails as $email)
				@if ($email->isChecked == true)
					<?php $a++; ?>
				@endif
			@endforeach

			<?php if ($a > 0) { ?>
				<ul class="collapsible" data-collapsible="accordion">
					Todos los demás
					@foreach ($emails as $email)
						@if ($email->isChecked == true)
							<li>
								<div class="collapsible-header">
									<i class="material-icons">mail_outline</i>
									<p><b>{{ $email->sender_name }}	{{ $email->subject }} </b><span class="truncate">- {{ $email->message }}</span></p>
								</div>
								<div class="collapsible-body">
									<section>{{ $email->message }}</section>
									<div class="divider"></div>
									<footer>
										<form action="{{ url('emails/email/'.$email->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											<input type="text" name="isChecked" value="false" class="hide">
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="left" data-delay="50" data-tooltip="Marcar como No Leído"><i class="material-icons">mail</i></button>
										</form>

										<form action="{{ url('emails/email/'.$email->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
										</form>
									</footer>
								</div>
							</li>
						@endif
					@endforeach
				</ul>
			<?php } ?>
		</section>
	@endif

@endsection