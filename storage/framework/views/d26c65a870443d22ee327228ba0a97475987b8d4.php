<div class="widget-head js-expand">
    <h2>
        <?php echo app('translator')->getFromJson('Active Balloons'); ?>

        <!-- <i class="ico-chevron-down"></i> -->
    </h2>
</div><!-- /.widget-head -->

<div class="widget-body" style ="display: block;">
    <ul class="list-balloons">
        <?php $__currentLoopData = $balloons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $balloon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('account.balloon-summary', ['balloon' => $balloon], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul><!-- /.list-balloons -->
</div><!-- /.widget-body -->