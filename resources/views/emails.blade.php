@extends('layouts.app')

@section('content')

	<header id="heademail">
		<div class="row">
			<h2 class="center">Buzón de Sugerencias</h2>
			<div class="divider"></div>
		</div>
	</header>

	<section class="row center">
		<form action="{{ url('email') }}" method="POST">
			{!! csrf_field() !!}
			<input type="text" name="isChecked" value="true" class="hide">
			<input type="text" name="sender_name" value="Carlos Beleño" class="hide">
			<input type="text" name="subject" value="Prueba Emails" class="hide">
			<input type="text" name="message" value="mis respetos para el atletic que ha sacado solo campergdjkkdfafskjabfslabfsslabfasbfasbflajsbflasbfblaones mira lo que dice jajajajaj q penorio los de Madrid" class="hide">
			<button type="submit" class="waves-effect waves-light btn"><i class="material-icons">add_to_queue</i></button>
		</form>
	</section>

	@if (count($emails) > 0)
		<section class="row">
			<?php $a=0 ?>
			@foreach ($emails as $email)
				@if ($email->isChecked == 0)
					<?php $a++; ?>
				@endif
			@endforeach

			<?php if ($a > 0) { ?>
				<ul class="collapsible" data-collapsible="accordion">
					No Leídos
					@foreach ($emails as $email)
						@if ($email->isChecked == 0)
							<li>
								<div class="collapsible-header">
									<div class="divider"></div>
									<i class="material-icons">mail</i> <b>{{ $email->sender_name }}</b><b> Asunto: {{ $email->subject }} </b>
									<div class="divider"></div>
								</div>
								<div class="collapsible-body">
									<p>{{ $email->message }}</p>
									<div class="divider"></div>
									<footer>
										<form action="{{ url('emails/email/'.$email->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
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
				@if ($email->isChecked == 1)
					<?php $a++; ?>
				@endif
			@endforeach

			<?php if ($a > 0) { ?>
				<ul class="collapsible" data-collapsible="accordion">
					Todos los demás
					@foreach ($emails as $email)
						@if ($email->isChecked == 1)
							<li>
								<div class="collapsible-header">
									<i class="material-icons">mail_outline</i>  {{ $email->sender_name }}      Asunto: {{ $email->subject }}
								</div>
								<div class="collapsible-body">
									<section>{{ $email->message }}</section>
									<div class="divider"></div>
									<footer>
										<form action="{{ url('emails/email/'.$email->id) }}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											<input type="text" name="isChecked" value="0" class="hide">
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