<?php $currencyService = app('App\Services\CurrencyService'); ?>



<?php $__env->startSection('content'); ?>

    <main class="main main-primary"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        id="cnt"
        >
        <section class="section-secondary">
            <header class="section-head">
                <div class="container">
                    <h2><?php echo app('translator')->getFromJson('Account Statistics'); ?></h2>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-statistics">
                        <li><?php echo app('translator')->getFromJson('Account Balance'); ?> <span><em class="currency-mark"><?php echo e($currencyService::convertCurrencyToMark($user->getBaseCurrency())); ?></em><?php echo e(number_format(abs($user->getBalance()), 2)); ?></span></li>

                        <li><?php echo app('translator')->getFromJson('Popped Balloon Gains'); ?> <span class="mark <?php echo e(($gainAmount < 0.00) ? 'negative' : ''); ?>"><?php echo e(($gainAmount >= 0.00) ? '+' : '-'); ?><em class="currency-mark"><?php echo e($currencyService::convertCurrencyToMark($user->getBaseCurrency())); ?></em><?php echo e(number_format(abs($gainAmount), 2)); ?></span></li>

                        <li><?php echo app('translator')->getFromJson('Active Balloon Gains'); ?> <span class="mark <?php echo e(($unrealizedAmount < 0.00) ? 'negative' : ''); ?>"><?php echo e(($unrealizedAmount >= 0.00) ? '+' : '-'); ?><em class="currency-mark"><?php echo e($currencyService::convertCurrencyToMark($user->getBaseCurrency())); ?></em><?php echo e(number_format(abs($unrealizedAmount), 2)); ?></span></li>

                        <li><?php echo app('translator')->getFromJson('Balloons Launched'); ?> <span><?php echo e(count($user->activeBalloons())); ?></span></li>

                        <li><?php echo app('translator')->getFromJson('Balloons Popped'); ?> <span><?php echo e(count($user->poppedBalloons())); ?></span></li>
                    </ul><!-- /.list-statistics -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->

<!--             <div class="section-icon">
                <i class="ico-baloon mobile-only"></i>

                <i class="ico-baloon-large desktop-only"></i>
            </div> -->
        </section><!-- /.section-secondary -->
    </main><!-- /.main main-primary -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>