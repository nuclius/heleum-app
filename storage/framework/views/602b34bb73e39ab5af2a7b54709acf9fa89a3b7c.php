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
                    <h1><?php echo app('translator')->getFromJson('Add Funds'); ?></h1>
                    <br/>
                    
                    <p><?php echo app('translator')->getFromJson('Heleum is currently paused while we develop Version 3.0. Learn more here: <a class="underline" href="https://heleum.com/heleum-paused/">heleum.com/heleum-paused</a>'); ?></p>
                    
                </header><!-- /.section-head -->
                
            </section><!-- /.section-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>