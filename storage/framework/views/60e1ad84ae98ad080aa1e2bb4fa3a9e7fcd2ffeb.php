<li <?php if($card->isFavorite()): ?> class="list-item-favorite" <?php endif; ?>>
    <a href="#"
        class="js-select-card"
        data-target="#selected-card"
        data-cardid="<?php echo e($card->getId()); ?>"
        data-currency="<?php echo e($card->getCurrency()); ?>"
        data-currencymark="<?php echo e($card->getCurrencyMark()); ?>"
        >
        <span>
            <small class="currency"><?php echo e($card->getCurrency()); ?></small>
        </span>

        <strong><?php echo e($card->getTitle()); ?></strong>

        <small><em class="currency-mark"><?php echo e($card->getCurrencyMark()); ?></em><?php echo e($card->getAvailable()); ?> <em class="currency"><?php echo e($card->getCurrency()); ?></em></small>

        <i class="ico-star"></i>
    </a>
</li>
