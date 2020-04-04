<?php $__env->startSection('title', 'Page Not Found'); ?>

<?php $__env->startSection('message'); ?>
    <p><?php echo e($exception->getMessage()); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>