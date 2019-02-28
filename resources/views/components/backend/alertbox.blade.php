@php
$type = 'danger';
if(Session::get('msg-type')){
	$type = Session::get('msg-type');
}
@endphp

@if(Session::has('msg') || $errors->any())
	<div class="card-block" style="">
		@if(Session::has('msg'))
			@foreach (Session::get('msg') as $key => $msg)
				@if($key != "error")
					<div class="alert alert-{{ $key }} alert-dismissable  my-0">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>    
							{!! ucWords($msg) !!}
					</div>	
				@endif            
			@endforeach
		@else
			<div class="alert alert-{{ $type }} alert-dismissable my-0">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<span>
					@foreach ($errors->all('<p class="mb-0">:message</p>') as $error)
						{!! ucWords($error) !!}
					@endforeach
				</span>
			</div>
		@endif
	</div>
	<div class="clearfix">&nbsp;</div>
@endif
