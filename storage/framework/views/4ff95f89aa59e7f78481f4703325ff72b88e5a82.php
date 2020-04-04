<?php if($errors->any()): ?>
    <div class="error-wrap container">
        <div class="row">
            <div class="two columns">&nbsp;</div>
            <div class="eight columns alert errors">
                <h3><?php echo app('translator')->getFromJson('Error'); ?></h3>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="error"><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="close-error"><?php echo app('translator')->getFromJson('Okay'); ?></button>
            </div>
            <div class="two columns">&nbsp;</div>
        </div>
    </div>
<?php endif; ?>
