<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.balloon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" data-show-balloon="true" id="cnt">
        <div class="container">
            <div class="form-funds">

                <?php echo $__env->make('partials.error-alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <form action="review-and-confirm" method="post" class="xjs-form-internal">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-head">
                        <h1>Add Funds</h1>
                    </div><!-- /.form-head -->

                    <div class="form-body">
                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-source" id="select-source" value="" placeholder="Select Source" readonly="readonly" data-toggle="modal" data-target="#card-modal" required>

                                <span class="form-field-value" id="selected-card"><strong></strong> <small></small></span>

                                <i class="form-row-icon form-row-icon-dots"></i>

                                <label for="select-source" class="form-label">Selected Source</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-amount" id="select-uphold-amount" value="" placeholder="Amount" data-validate="min" required>

                                <span class="form-currency-mark currency-mark"></span>

                                <span class="form-currency currency"></span>

                                <label for="select-uphold-amount" class="form-label">Amount</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <p>Minimum Amount: <?php echo e(Auth::user()->getBaseCurrencySymbol()); ?><?php echo e(Auth::user()->getMinimumAddFundsAmount()); ?> <?php echo e(Auth::user()->getBaseCurrency()); ?></p>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->
                    </div><!-- /.form-body -->

                    <div class="form-actions">
                        <input type="hidden" name="selected-card-id" id="selected-card-id" value="" required="required" />
                        <input type="hidden" name="selected-currency" id="selected-currency" value="" required="required" />

                        <button type="submit" class="btn btn-primary" disabled id="btn-select-currency">Proceed to Next Step</button>
                    </div><!-- /.form-actions -->
                </form>

                <div class="modal" id="card-modal">
                    <div class="modal-inner">
                        <div class="modal-head">
                            <h2>Choose a Funding Source</h2>

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