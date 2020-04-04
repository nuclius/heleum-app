<!DOCTYPE html>
<html lang="en" class="<?php if(auth()->guard()->check()): ?> app-loaded <?php endif; ?>">

<?php echo $__env->make('partials.global.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>
	<?php if(auth()->guard()->guest()): ?>
	<div class="splash">
		<div class="splash-image fullsize-background" style="background-image: url(/css/images/temp/clouds.jpg);"></div><!-- /.splash-image -->

		<div class="splash-logo">
			<img src="/css/images/logo-splash@2x.png" alt="Heleum Brand Image">

			<img src="/css/images/logo-splash-part@2x.png" alt="Heleum Brand Image" class="splash-logo-letter">
		</div><!-- /.splash-logo -->

		<button type="button" class="btn btn-light" id="button-start">Get Started</button>
	</div><!-- /.splash fullsize-background -->
	<?php endif; ?>

	<?php echo $__env->make('partials.global.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="wrapper">

		<?php echo $__env->make('partials.global.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->yieldContent('content'); ?>

	</div><!-- /.wrapper -->

	<?php if(env('APP_ENV') != 'production'): ?>
		<div style="position:fixed; bottom:0; background-color:yellow; width:100%; text-align:center;"><h2>Environment: <?php echo e(env('APP_ENV')); ?></h2></div>
	<?php endif; ?>

	<!-- Vendor JS -->
	<script src="/vendor/jquery/dist/jquery.min.js"></script>

	<!-- App JS -->
	<script type="text/javascript">
		var activeCurrency = '<?php echo e(strtolower(Auth::user()->base_currency)); ?>';

		<?php $currencyService = app('App\Services\CurrencyService'); ?>
		var currencyOptions = <?php echo json_encode($currencyService::getCurrencyOptions(), 0, 512) ?>
	</script>
	<script src="/js/functions.js?v=1.6"></script>
</body>
</html>

