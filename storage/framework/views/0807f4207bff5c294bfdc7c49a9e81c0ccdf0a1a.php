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
            <div class="form-funds">

                <?php echo $__env->make('partials.error-alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <form action="review-and-confirm" method="post" class="xjs-form-internal">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-head">
                        <h1><?php echo app('translator')->getFromJson('Withdraw Funds'); ?></h1>
                        <h3><?php echo app('translator')->getFromJson('Your account balance is: '); ?> <span class="currency-mark"><?php echo e($currencyMark); ?></span><?php echo e(number_format($user->getBalance(), 2)); ?> <?php echo e($currency); ?>

                    </div><!-- /.form-head -->

                    <div class="form-body">
                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-card" id="select-uphold-card" value="" placeholder="Select Uphold Card" readonly="readonly" data-toggle="modal" data-target="#card-modal" required>

                                <span class="form-field-value" id="selected-card"><strong></strong> <small></small></span>

                                <i class="form-row-icon form-row-icon-dots"></i>

                                <label for="select-uphold-card" class="form-label"><?php echo app('translator')->getFromJson('Selected Card'); ?></label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-amount" id="select-uphold-amount" value="" placeholder="Amount" required> <!-- data-validate="min" -->

                                <span class="form-currency-mark currency-mark"></span>

                                <span class="form-currency currency"></span>

                                <label for="select-uphold-amount" class="form-label"><?php echo app('translator')->getFromJson('Amount'); ?></label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <p class="alert" style="text-align: center;">
                            <strong>NOTE:</strong> Withdrawing may pop active balloons.
                        </p>
                    </div><!-- /.form-body -->

                    <div class="form-actions">
                        <input type="hidden" name="selected-card-id" id="selected-card-id" value="" required="required" />
                        <input type="hidden" name="selected-currency" id="selected-currency" value="" required="required" />

                        <button type="submit" class="btn btn-primary" disabled id="btn-select-currency"><?php echo app('translator')->getFromJson('Proceed to Next Step'); ?></button>
                    </div><!-- /.form-actions -->
                </form>

                <div class="modal" id="card-modal">
                    <div class="modal-inner">
                        <div class="modal-head">
                            <h2><?php echo app('translator')->getFromJson('Select an Uphold Card'); ?></h2>

                            <button type="button" class="btn btn-clear modal-close">
                                <i class="ico-add"></i>
                            </button>
                        </div><!-- /.modal-head -->

                        <div class="modal-body">
                            <ul class="list-accounts">
                                <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('partials.card', ['card' => $card], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul><!-- /.list-accounts -->
                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-inner -->
                </div><!-- /#card-modal.modal -->
            </div><!-- /.form-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>