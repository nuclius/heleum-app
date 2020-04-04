<li>
    
    <p>
        <?php if(trim($referral->referredName()) === ''): ?>
            <?php echo e($referral->referred_email); ?>

        <?php else: ?>
            <?php echo e($referral->referredName()); ?>

        <?php endif; ?>
    </p>


    
    <strong>
        <?php echo e($referral->getTimeTillBoostActivation()); ?>

    </strong>
</li>
