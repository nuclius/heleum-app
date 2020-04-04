<?php $__env->startSection('content'); ?>

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="true" data-show-back-button="false" id="cnt">
        <section class="section">
            
            <header class="section-head" style="display: none">
                <div class="container">
                    <?php if(Auth::user()->isVerified()): ?>
                        <div style="float:right;">
                            <a href="/add-funds" style="text-decoration:underline;">ADD FUNDS</a>

                            &nbsp;&nbsp;

                            <a href="/withdraw-funds" style="text-decoration:underline;">WITHDRAW</a>
                        </div>
                    <?php endif; ?>

                    <h2 class="section-title"><?php echo app('translator')->getFromJson('Account Overview'); ?></h2><!-- /.section-title -->

                    
                </div>
            </header>

            
        </section>

        <section class="section">
            <header class="section-head-primary overview-row">
                <div class="container">
                    <div class="row">
                        <div class="overview-entry four columns text-left">
                            <?php echo app('translator')->getFromJson('Balance: '); ?> <strong><i class="currency-mark"><?php echo e($currencyMark); ?></i><?php echo e(number_format($balance, 2)); ?> <?php echo e($currency); ?></strong>
                        </div>

                        <div class="overview-entry four columns text-center">
                            <?php echo app('translator')->getFromJson('In Balloons: '); ?> <strong><i class="currency-mark"><?php echo e($currencyMark); ?></i><?php echo e(number_format($activeBalloonAmounts, 2)); ?> <?php echo e($currency); ?></strong>
                        </div>

                        <div class="overview-entry four columns text-right">
                            <?php echo app('translator')->getFromJson('Not In Balloons: '); ?> <strong><i class="currency-mark"><?php echo e($currencyMark); ?></i><?php echo e(number_format($notInBalloons, 2)); ?> <?php echo e($currency); ?></strong>
                        </div>
                    </div>
                    
                </div><!-- /.container -->
            </header><!-- /.section-head-primary -->

            <div class="section-body section-balloons-scrollable">
                <div class="container">
                    <?php if(Auth::user()->isVerified()): ?>
                        <div class="widgets">
                            <div class="widget widget-expanded">
                                <?php echo $__env->make('account.balloons-active', ['balloons' => $activeBalloons], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div><!-- /.widget -->

                            <div class="widget">
                                <?php echo $__env->make('account.balloons-popped', ['balloons' => $poppedBalloons], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div><!-- /.widget -->
                        </div><!-- /.widgets -->
                        <div class="large-top-spacing">
                            <div class="eight columns alert" style="background-color: #99ddff">
                                <p>Heleum is currently paused while we develop Version 3.0. <a class="underline" href="https://heleum.com/heleum-paused">Learn More here.</a></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="large-top-spacing">
                            <div class="two columns">&nbsp;</div>
                            <div class="eight columns alert" style="background-color: #99ddff">
                                <?php if(Auth::user()->isPhpBrownbag()): ?>
                                    <p>Welcome to Heleum, Lambda School!</p>
                                <?php else: ?>
                                    <p>Heleum is currently paused while we develop Version 3.0. <a class="underline" href="https://heleum.com/heleum-paused">Learn More here.</a></p>
                                    
                                <?php endif; ?>
                            </div><!-- /.notice -->
                        </div>
                    <?php endif; ?>
                </div><!-- /.container -->
            </div><!-- /.section-body section-balloons-scrollable -->
        </section><!-- /.section -->
    </main><!-- /.main main-primary -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>