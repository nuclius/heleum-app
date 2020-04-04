<tr>
    <td>
        <div><?php echo app('translator')->getFromJson('Funding'); ?></div>
    </td>

    <td>
        <div>
            <span><small class="mobile-only"><?php echo app('translator')->getFromJson('From'); ?> </small><?php echo e($txn->source_currency); ?> <?php echo app('translator')->getFromJson('Card'); ?></span>
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
            <span class="deposit">+<em class="currency-mark"><?php echo e($currencyService::convertCurrencyToMark($txn->source_currency)); ?></em><?php echo e(number_format($txn->amount, 2)); ?></span>
        </div>
    </td>
</tr>
