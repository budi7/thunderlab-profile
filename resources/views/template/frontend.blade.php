@extends('layouts.frontend')

@section('template_content')

    <!--  Loader  -->
    <div id="myloader">
        <div class="loader">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!--  END Loader  -->

    <!--  Main Wrap  -->
    <div id="main-wrap">
        @include('template.frontend.header')
        @stack('content')
        @include('template.frontend.footer')

        @stack('modals')
    </div>
    <!--  Main Wrap  -->
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
