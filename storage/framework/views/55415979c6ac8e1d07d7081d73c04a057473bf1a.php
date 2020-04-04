<li>
    <a href="/balloon/<?php echo e($balloon->user_balloon_id); ?>" class="js-link-internal">
        <i class="ico-baloon-1"></i>

        <strong><?php echo app('translator')->getFromJson('Balloon'); ?> <?php echo e($balloon->user_balloon_id); ?>: <?php echo e($balloon->getCurrentCurrency()); ?></strong>

        <?php if($balloon->isActive()): ?>
            <small><?php echo app('translator')->getFromJson('Launched:'); ?> <?php echo e($balloon->getStartDate()); ?></small>
        <?php else: ?>
            <small><?php echo e($balloon->getStartDate()); ?> <?php echo app('translator')->getFromJson('to'); ?> <?php echo e($balloon->getEndDate()); ?></small>
        <?php endif; ?>

        
        <?php if($balloon->isPopped()): ?>
            <em style="right: 100px">
        <?php else: ?>
            <em>
        <?php endif; ?>
            <?php echo e(($balloon->isUp()) ? '+' : '-'); ?><?php echo e(abs($balloon->getPercentChange())); ?>%
        </em>

        <?php if($balloon->isPopped()): ?>
            <span><?php echo app('translator')->getFromJson('Popped!'); ?></span>
        <?php endif; ?>
    </a>
</li>
