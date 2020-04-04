<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.balloon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <main class="main"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        data-show-balloon="true"
        id="cnt"
        >
        <div class="container">
            <section class="section-funds">
                <header class="section-head">
                    <h1><?php echo app('translator')->getFromJson('Withdraw Funds'); ?></h1>

                    
                </header><!-- /.section-head -->

                <div class="section-actions">
                    <a href="/withdraw-funds/uphold" class="btn btn-primary js-link-internal"><?php echo app('translator')->getFromJson('To Uphold Card'); ?></a>

                    
                </div><!-- /.section-actions -->
            </section><!-- /.section-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>