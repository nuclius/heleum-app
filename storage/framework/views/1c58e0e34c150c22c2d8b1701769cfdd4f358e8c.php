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
                    <h2>Funding History</h2>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <div class="table-history">
                        <table>
                            <?php $__currentLoopData = $accountTxns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($txn->withdrawal_id)): ?>
                                    <?php echo $__env->make('history.withdrawal-row', ['txn' => $txn], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php elseif(!empty($txn->fee_id)): ?>
                                    <?php echo $__env->make('history.fee-row', ['txn' => $txn], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php else: ?>
                                    <?php echo $__env->make('history.funding-row', ['txn' => $txn], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div><!-- /.table-history -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->
        </section><!-- /.section-secondary -->
    </main><!-- /.main main-primary -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>