<!DOCTYPE html>
<html lang="en" class="">

<?php echo $__env->make('partials.global.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>


	<div class="splash">
		<div class="splash-image fullsize-background" style="background-image: url(/css/images/temp/clouds.jpg); filter:brightness(80%);"></div><!-- /.splash-image -->

		<div class="splash-logo">
			<img src="/css/images/logo-splash@2x.png" alt="Heleum Brand Image">

			<img src="/css/images/logo-splash-part@2x.png" alt="Heleum Brand Image" class="splash-logo-letter">
		</div><!-- /.splash-logo -->

		<style type="text/css">
/*			.introvideo {
				z-index: 20;
			}
*/			.btn-light {
				height: unset;
			}
		</style>

		<div class="container" style="z-index: 100;">
			<div class="row">
				<div class="two columns">
					&nbsp;
				</div>
				<div class="four columns">
					<a href="https://heleum.com" class="btn btn-light" id="button-start">Learn More</a>
				</div>
				<div class="four columns">
					<a href="/login" class="btn btn-light" id="button-start">Get Started *</a>
				</div>
			</div>
			<div class="row">
				<div class="two columns">
					&nbsp;
				</div>
				<div class="eight columns">
					<div style="padding: 5px 2px; color: white; filter:drop-shadow(4px 4px 8px black)">
						* By authorizing Heleum, you consent to the terms of the <u><a href="http://heleum.com/terms/" title="Heleum User Agreement">Heleum User License Agreement</a></u>. Heleum is not available for Uphold users in New York.
					</div>
				</div>
			</div>
		</div>



		



	</div><!-- /.splash fullsize-background -->


	<!-- Vendor JS -->
	<script src="/vendor/jquery/dist/jquery.min.js"></script>

	<!-- App JS -->
	<script src="/js/functions.js?v=1.6"></script>
</body>
</html>

