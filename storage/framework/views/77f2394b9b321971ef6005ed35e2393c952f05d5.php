<li>
    <p><b>Move <?php echo e($txn->move_number); ?>:</b>&nbsp;&nbsp;&nbsp;<?php echo e($txn->origin_amount); ?> <?php echo e($txn->origin_currency); ?> <?php echo app('translator')->getFromJson('to'); ?> <?php echo e($txn->dest_amount); ?> <?php echo e($txn->dest_currency); ?> <small><?php echo e($txn->transaction_timestamp->format('Y-m-d H:i:s')); ?> UTC</small></p>

    <strong><em class="currency-mark"><?php echo e($txn->getCurrencyMark(Auth::user()->base_currency)); ?></em><?php echo e($txn->latestAmountIn(Auth::user()->base_currency)); ?></strong>
</li>
