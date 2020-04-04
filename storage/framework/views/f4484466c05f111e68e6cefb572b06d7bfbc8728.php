<?php $__env->startSection('content'); ?>

    <main class="main main-primary"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        id="cnt"
        >

        <div class="container">
            <section class="section-popped section-popped--alt">
                <header class="section-head">
                    <h1><?php echo app('translator')->getFromJson('Balloon'); ?> <?php echo e($balloon->user_balloon_id); ?> <?php if($balloon->isPopped()): ?> <?php echo app('translator')->getFromJson('Popped!'); ?> <?php endif; ?></h1>
                </header><!-- /.section-head -->
            </section>
        </div>

        <?php if($balloon->isPopped()): ?>
            

            <div class="container">
                <section class="section-popped section-popped--alt">
                    <div class="section-body">
                        <ul class="list-balloon-details">
                            <li><?php echo app('translator')->getFromJson('Launched'); ?> <?php echo e($balloon->getStartDate('j M Y')); ?> <span><em class="currency-mark"><?php echo e($balloon->getLaunchCurrencyMark()); ?></em><?php echo e(number_format($balloon->getlaunchAmount(), 2)); ?> <em class="currency"><?php echo e($balloon->getLaunchCurrency()); ?></em></span></li>

                            <li><?php echo app('translator')->getFromJson('Popped'); ?> <?php echo e($balloon->getEndDate('j M Y')); ?> <span><em class="currency-mark"><?php echo e($balloon->getCurrentCurrencyMark()); ?></em><?php echo e(number_format($balloon->getCurrentAmount(), 2)); ?> <em class="currency"><?php echo e($balloon->getCurrentCurrency()); ?></em></span></li>

                            <li><?php echo app('translator')->getFromJson('Your Share'); ?> <span class="mark"><em class="currency-mark"><?php echo e($balloon->pop->getCurrencyMark()); ?></em><?php echo e(number_format($balloon->pop->getGains(), 2)); ?> <em class="currency"><?php echo e($balloon->pop->getCurrency()); ?></em></span></li>

                            <li><?php echo app('translator')->getFromJson('Heleum&rsquo;s Share'); ?> <span><em class="currency-mark"><?php echo e($balloon->pop->getCurrencyMark()); ?></em><?php echo e(number_format($balloon->pop->heleum_fee_amount, 2)); ?> <em class="currency"><?php echo e($balloon->pop->getCurrency()); ?></em></span></li>
                        </ul><!-- /.list-balloon-details -->
                    </div><!-- /.section-body -->
                </section><!-- /.section-popped -->
            </div><!-- /.container -->
        <?php endif; ?>

        

        <section class="section">
            <header class="section-head-primary section-head-primary-reverse">
                <div class="container">
                    <?php if($balloon->hasMoves()): ?>
                        <h3><?php echo app('translator')->getFromJson('Launch Amount:'); ?> <strong>&nbsp;&nbsp;<span class="currency-mark"><?php echo e($balloon->getLaunchCurrencyMark()); ?></span><?php echo e(number_format($balloon->getlaunchAmount(), 2)); ?></strong></h3>

                        <h4><?php echo app('translator')->getFromJson('Current Amount:'); ?> <strong>&nbsp;&nbsp;<span class="currency-mark"><?php echo e($balloon->getCurrentCurrencyMark()); ?></span><?php echo e(number_format($balloon->getCurrentAmount(), 2)); ?></strong></h4>
                    <?php else: ?>
                        <h3><?php echo app('translator')->getFromJson('Waiting to Launch:'); ?> <strong>&nbsp;&nbsp;<span class="currency-mark"><?php echo e($balloon->getLaunchCurrencyMark()); ?></span><?php echo e(number_format($balloon->getlaunchAmount(), 2)); ?></strong></h3>
                    <?php endif; ?>
                </div><!-- /.container -->
            </header><!-- /.section-head-primary section-head-primary-reverse -->

            <?php if($balloon->hasMoves()): ?>
            <div class="section-body section-transactions-scrollable">
                <div class="container">
                    <div class="widgets">
                        <div class="widget widget-wide">
                            <ul class="list-transactions">
                                <?php $__currentLoopData = $balloon->transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('balloon.transaction', ['txn' => $txn], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul><!-- /.list-transactions -->

                            <?php if($balloon->isActive()): ?>
                                <p>The initial value of the balloon at launch includes an Uphold conversion fee. Balloons can remain active for 30-90 days and fluctuate significantly in value before popping at a gain.</p>
                            <?php endif; ?>

                        </div><!-- /.widget widget-wide -->
                    </div><!-- /.widgets -->
                </div><!-- /.container -->
            </div><!-- /.section-body section-transactions-scrollable -->
            <?php endif; ?>
        </section><!-- /.section -->
    </main><!-- /.main main-primary -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>