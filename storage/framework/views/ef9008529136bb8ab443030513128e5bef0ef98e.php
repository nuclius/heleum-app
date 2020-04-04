<tr>
    <td>
        <div><?php echo app('translator')->getFromJson('Withdrawal'); ?></div>
    </td>

    <td>
        <div>
            <span><small class="mobile-only"><?php echo app('translator')->getFromJson('To'); ?> </small><?php echo e($txn->destination_currency); ?> <?php echo app('translator')->getFromJson('Card'); ?></span>
        </div>
    </td>

    <td>
        <div>
            <span><?php echo e($txn->timestamp->format('d M Y')); ?></span>
        </div>
    </td>

    <td>
        <div>
            <?php $currencyService = app('App\Services\CurrencyService'); ?>
            <span class="withdraw">-<em class="currency-mark"><?php echo e($currencyService::convertCurrencyToMark($txn->destination_currency)); ?></em><?php echo e(number_format($txn->amount, 2)); ?></span>
        </div>
    </td>
</tr>
