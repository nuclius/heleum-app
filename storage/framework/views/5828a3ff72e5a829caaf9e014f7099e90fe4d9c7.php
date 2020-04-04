<?php $__env->startSection('content'); ?>

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">
        <section class="section-primary">
            <header class="section-head">
                <div class="container">
                    <h1><?php echo app('translator')->getFromJson('Boosts'); ?></h1>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-boosts">
                        <li>
                            <p>
                                <span><?php echo app('translator')->getFromJson('Share of Gains'); ?></span>
                            </p>


                            <p>60% <?php if($user->hasBoosts()): ?><strong> + <?php echo e($boostPercentage); ?>%</strong><?php endif; ?></p>
                        </li>

                        <!-- NO ACTIVATED BOOSTS AT THIS MOMENT
                        <li>
                            <p>Boost</p>

                            <p>Active until 15 Jun 2017</p>
                        </li>
                        -->
                    </ul><!-- /.list-boosts -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->

            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">Earn Boosts</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-boosts">
                        <li>
                            <p><?php echo app('translator')->getFromJson('Refer friends'); ?></p>

     
                        </li>
                        <li>
                            <p>Your referral link: <strong><?php echo e($user->referralCodeUrl()); ?></strong></p>

                            <div class="socials">
                                <button data-url="<?php echo e($user->referralCodeUrl()); ?>" id="copy-link" class="socials-copy">

                                    <span>Copy Link</span>

                                    <span>Copied <small></small></span>
                                </button>
                            </div><!-- /.socials -->
                        </li>
                        <li>
                            <p>For each user you refer that is active for 30 days you'll get a 1% Boost to your Gains! (Up to <?php echo e(Auth::user()->hasBetaBoost() ? 40 : 20); ?> users)</p>
                        </li>
                    </ul><!-- /.list-boosts -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->



            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title"><?php echo app('translator')->getFromJson('Active Boosts'); ?></h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->
            <div class="section-body">
                <div class="container">
                    <ul class="list-referrals">
                        <?php $__currentLoopData = $user->boosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('boosts.boost', ['boost' => $boost], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul><!-- /.list-referrals -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->



            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title"><?php echo app('translator')->getFromJson('Pending Boosts'); ?></h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->
            <div class="section-body">
                <div class="container">
                    <div class="row">
                        <?php
                        $referrals = $user->pendingBoosts();
                        if ($referrals->count() > 0) {
                            ?>
                            <ul class="list-referrals">
                                <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('boosts.pending', ['referral' => $referral], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul><!-- /.list-referrals -->
                            <?php
                        } else {
                            ?>
                            No Pending Boosts
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <p>If you aren't seeing someone you referred, please <a href="https://support.heleum.com/new" class="" target="_blank">contact support</a>.</p>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.section-body -->


        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>