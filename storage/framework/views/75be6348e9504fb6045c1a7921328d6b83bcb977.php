<?php $__env->startSection('content'); ?>

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review">
                <header class="section-head">
                    <i class="circle-2 mobile-only"></i>

                    <i class="circle-2-large desktop-only"></i>

                    <h1>A Note about Your Account</h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <p>Due to cryptocurrency regulations in the State of New York, residents of the state
                        cannot use Heleum at this time, as Uphold does not currently have a BitLicense in
                        the State of New York. Please contact <a href="https://support.heleum.com/new"
                        class="" target="_blank">Support</a> for more information.</p>
                </div><!-- /.section-body -->

                <footer class="section-foot">
                    <a href="/logout" class="btn btn-primary js-link-internal">Log Out</a>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review -->
        </div><!-- /.container -->
    </main><!-- /.main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>