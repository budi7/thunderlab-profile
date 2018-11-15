@extends('layouts.backend')

@section('template_content')
	<div class="wrapper ">
		@include('template.backend.sidebar')
		
		<div class="main-panel">
			@include('template.backend.header')

			<div class="content">
				@stack('content')
			</div>
			
			@include('template.backend.footer')
		</div>		
	</div>

	@stack('modals')
@stop


@section('template_script')
	<script type="text/javascript">
		function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
		// use like
		r(function(){
			@stack('scripts')
		});	
	</script>

	@stack('script_plugins')
@stop
