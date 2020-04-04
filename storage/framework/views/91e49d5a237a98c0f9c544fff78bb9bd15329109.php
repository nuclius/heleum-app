<?php $__env->startSection('content'); ?>

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review">
                <header class="section-head">
                    <i class="circle-2 mobile-only"></i>

                    <i class="circle-2-large desktop-only"></i>
                    <h1>Funding request submitted for <i class="currency-mark"><?php echo e(session('currencyMark')); ?></i><?php echo e(session('amount')); ?> <i class="currency"><?php echo e(session('currency')); ?></i></h1>
                    <h1><?php echo app('translator')->getFromJson('If pending for longer than 30 minutes, please contact <u><a href="https://support.heleum.com/new" class="" target="_blank"> Heleum Support</a></u> from the menu.'); ?></h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <ul class="list-funds">
                        <li>
                            <span>
                                <small><?php echo e(session('currency')); ?></small>
                            </span>

                            <em class="funds-withdraw">- <i class="currency-mark"><?php echo e(session('currencyMark')); ?></i><?php echo e(session('amount')); ?> <i class="currency"><?php echo e(session('currency')); ?></i></em>

                            <strong>From <?php echo e(session('cardName')); ?> - <small>Debit</small></strong>
                        </li>

                        <li>
                            <span>
                                <small class="heleum">H<sup>e</sup></small>
                            </span>

                            <em class="funds-deposit">+ <i class="currency-mark"><?php echo e(session('currencyMark')); ?></i><?php echo e(session('amount')); ?> <i class="currency"><?php echo e(session('currency')); ?></i></em>

                            <strong>To Your Heleum App</strong>
                        </li>
                    </ul><!-- /.list-funds -->
                </div><!-- /.section-body -->

                <footer class="section-foot">
                    <a href="/account" class="btn btn-primary js-link-internal">Continue</a>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review -->
        </div><!-- /.container -->
    </main><!-- /.main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>