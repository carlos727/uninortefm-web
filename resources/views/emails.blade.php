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
									<div class="row">
										<div class="col s10">
											<i class="material-icons">mail</i>
											<b>{{ $email->sender_name }}</b> <span>({{ $email->email }})</span>
										</div>
										<div class="col s2"><b class="right">{{ $email->created_at->format('M d') }}</b></div>
									</div>
								</div>
								<div class="collapsible-body">
									<p>{{ $email->message }}</p>
									<div class="divider"></div>
									<footer class="row">
										<form action="{{ url('emails/email/'.$email->id) }}" method="POST" class="col s1 offset-s10">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="left" data-delay="50" data-tooltip="Marcar como Leído"><i class="material-icons">mail_outline</i></button>
										</form>

										<form action="{{ url('emails/email/'.$email->id) }}" method="POST" class="col s1">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="top" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
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
					Leídos
					@foreach ($emails as $email)
						@if ($email->isChecked == true)
							<li>
								<div class="collapsible-header">
									<div class="row">
										<div class="col s10">
											<i class="material-icons">mail_outline</i>
											<span>{{ $email->sender_name }} - {{ $email->subject }}</span>
										</div>
										<div class="col s2"><sapn class="right">{{ $email->created_at->format('M d') }}</sapn></div>
									</div>
								</div>
								<div class="collapsible-body">
									<p>{{ $email->message }}</p>
									<div class="divider"></div>
									<footer class="row">
										<form action="{{ url('emails/email/'.$email->id) }}" method="POST" class="col s1 offset-s10">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="left" data-delay="50" data-tooltip="Marcar como NO Leído"><i class="material-icons">mail</i></button>
										</form>

										<form action="{{ url('emails/email/'.$email->id) }}" method="POST" class="col s1">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="submit" class="waves-effect waves-light btn tooltipped" data-position="top" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete_forever</i></button>
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