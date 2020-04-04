<!DOCTYPE html>
<html lang="en" class="@auth app-loaded @endauth">

@include('partials.global.head')

<body>
	@guest
	<div class="splash">
		<div class="splash-image fullsize-background" style="background-image: url(/css/images/temp/clouds.jpg);"></div><!-- /.splash-image -->

		<div class="splash-logo">
			<img src="/css/images/logo-splash@2x.png" alt="Heleum Brand Image">

			<img src="/css/images/logo-splash-part@2x.png" alt="Heleum Brand Image" class="splash-logo-letter">
		</div><!-- /.splash-logo -->

		<button type="button" class="btn btn-light" id="button-start">Get Started</button>
	</div><!-- /.splash fullsize-background -->
	@endguest

	@include('partials.global.nav')

	<div class="wrapper">

		@include('partials.global.header')

		@yield('content')

	</div><!-- /.wrapper -->

	@if (env('APP_ENV') != 'production')
		<div style="position:fixed; bottom:0; background-color:yellow; width:100%; text-align:center;"><h2>Environment: {{ env('APP_ENV') }}</h2></div>
	@endif

	<!-- Vendor JS -->
	<script src="/vendor/jquery/dist/jquery.min.js"></script>

	<!-- App JS -->
	<script type="text/javascript">
		var activeCurrency = '{{ strtolower(Auth::user()->base_currency) }}';

		@inject('currencyService', 'App\Services\CurrencyService')
		var currencyOptions = @json($currencyService::getCurrencyOptions())
	</script>
	<script src="/js/functions.js?v=1.6"></script>
</body>
</html>

