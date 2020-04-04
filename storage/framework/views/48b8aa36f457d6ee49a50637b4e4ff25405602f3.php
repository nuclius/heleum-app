<?php $__env->startSection('content'); ?>

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review">
                <header class="section-head">
                    <i class="circle-3 mobile-only"></i>

                    <i class="circle-3-large desktop-only"></i>

                    <h1><?php echo app('translator')->getFromJson('You are Withdrawing'); ?> <br><em class="currency-mark"><?php echo e($currencyMark); ?></em><?php echo e($amount); ?> <em class="currency"><?php echo e($currency); ?></em> from Your Account</h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <ul class="list-funds">
                        <li>
                            <span>
                                <small class="heleum">H<sup>e</sup></small>
                            </span>

                            <em class="funds-withdraw">- <i class="currency-mark"><?php echo e($currencyMark); ?></i><?php echo e($amount); ?> <i class="currency"><?php echo e($currency); ?></i></em>

                            <strong><?php echo app('translator')->getFromJson('From My Heleum Account'); ?></strong>
                        </li>

                        <li>
                            <span>
                                <small><?php echo e($currency); ?></small>
                            </span>

                            <em class="funds-deposit">+ <i class="currency-mark"><?php echo e($currencyMark); ?></i><?php echo e($amount); ?> <i class="currency"><?php echo e($currency); ?></i></em>

                            <strong>To My <?php echo e($cardName); ?></strong>
                        </li>
                    </ul><!-- /.list-funds -->
                </div><!-- /.section-body -->

                <footer class="section-foot">
                    <form action="transfer-funds" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="amount" value="<?php echo e($amount); ?>" required="required">
                        <input type="hidden" name="selected-card-id" value="<?php echo e($cardId); ?>" required="required">
                        <input type="hidden" name="currencyMark" value="<?php echo e($currencyMark); ?>" required="required">
                        <input type="hidden" name="currency" value="<?php echo e($currency); ?>" required="required">

                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('Complete Transaction'); ?></button>
                    </form>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review -->
        </div><!-- /.container -->
    </main><!-- /.main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>