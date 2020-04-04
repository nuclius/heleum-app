<li>
    
    <?php if($boost->type === 'referral'): ?>
        <p><?php echo app('translator')->getFromJson('Referred'); ?> <?php echo e($boost->referredWho()); ?></p>
    
    <?php endif; ?>

    <strong>+ <?php echo e($boost->percentage()); ?>%</strong>

    
</li>
