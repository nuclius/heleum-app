<?php $__env->startSection('content'); ?>

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="true" data-show-back-button="false" id="cnt">
        <section class="section">
            <header class="section-head">
                <div class="container">
                    <h2 class="section-title">Account Overview <?php echo e($foo); ?></h2><!-- /.section-title -->

                    <div class="section-head-actions">
                        <span class="desktop-only">Change View:</span>

                        <a href="#weekly-statistics" data-toggle="tab" role="button" class="btn btn-secondary current">Weekly</a>

                        <a href="#monthly-statistics" data-toggle="tab" role="button" class="btn btn-secondary">Monthly</a>
                    </div><!-- /.section-head-actions -->
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="tabs">
                    <div class="tab current" id="weekly-statistics">
                        <div class="chart">
                            <a href="statistics" class="mobile-only js-link-internal" style="height: 216px; background: url(css/images/temp/chart1-mobile.jpg) no-repeat 0 50% / cover;"></a>

                            <a href="statistics" class="desktop-only js-link-internal" style="height: 400px; background: url(css/images/temp/chart1-desktop.jpg) no-repeat 0 50% / cover;"></a>
                        </div><!-- /.chart -->
                    </div><!-- /#weekly-statistics.tab -->

                    <div class="tab" id="monthly-statistics">
                        <div class="chart">
                            <a href="statistics" class="mobile-only js-link-internal" style="height: 216px; background: url(css/images/temp/chart1-mobile.jpg) no-repeat 0 50% / cover;"></a>

                            <a href="statistics" class="desktop-only js-link-internal" style="height: 400px; background: url(css/images/temp/chart1-desktop.jpg) no-repeat 0 50% / cover;"></a>
                        </div><!-- /.chart -->
                    </div><!-- /#monthly-statistics.tab -->
                </div><!-- /.tabs -->
            </div><!-- /.section-body -->
        </section><!-- /.section -->

        <section class="section">
            <header class="section-head-primary">
                <div class="container">
                    <h3>Current Balance: <strong><i class="currency-mark">£</i>152.54 <em class="currency">GBP</em></strong></h3>

                    <h4>Past 7 Days: <strong>+ <i class="currency-mark">£</i>2.54 <em class="currency">GBP</em></strong></h4>
                </div><!-- /.container -->
            </header><!-- /.section-head-primary -->

            <div class="section-body section-balloons-scrollable">
                <div class="container">
                    <div class="widgets">
                        <div class="widget">
                            <div class="widget-head js-expand">
                                <h2>
                                    Active Balloons

                                    <i class="ico-chevron-down"></i>
                                </h2>
                            </div><!-- /.widget-head -->

                            <div class="widget-body">
                                <ul class="list-balloons">
                                    <li>
                                        <a href="popped-balloon-detail-active" class="js-link-internal">
                                            <i class="ico-baloon-1"></i>

                                            <strong>Balloon 8</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="popped-balloon-detail-active" class="js-link-internal">
                                            <i class="ico-baloon-2"></i>

                                            <strong>Balloon 7</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="popped-balloon-detail-active" class="js-link-internal">
                                            <i class="ico-baloon-3"></i>

                                            <strong>Balloon 6</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="popped-balloon-detail-active" class="js-link-internal">
                                            <i class="ico-baloon-4"></i>

                                            <strong>Balloon 5</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>
                                        </a>
                                    </li>
                                </ul><!-- /.list-balloons -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget -->

                        <div class="widget">
                            <div class="widget-head js-expand">
                                <h2>
                                    Popped Balloons

                                    <i class="ico-chevron-down"></i>
                                </h2>
                            </div><!-- /.widget-head -->

                            <div class="widget-body">
                                <ul class="list-balloons ballons-popped">
                                    <li>
                                        <a href="popped-balloon-detail" class="js-link-internal">
                                            <i class="ico-baloon-1"></i>

                                            <strong>Balloon 4</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>

                                            <em>+ <i class="currency-mark">£</i>17.54</em>

                                            <span>Popped!</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="popped-balloon-detail" class="js-link-internal">
                                            <i class="ico-baloon-2"></i>

                                            <strong>Balloon 3</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>

                                            <em>+ <i class="currency-mark">£</i>17.54</em>

                                            <span>Popped!</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="popped-balloon-detail" class="js-link-internal">
                                            <i class="ico-baloon-3"></i>

                                            <strong>Balloon 2</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>

                                            <em>+ <i class="currency-mark">£</i>17.54</em>

                                            <span>Popped!</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="popped-balloon-detail" class="js-link-internal">
                                            <i class="ico-baloon-4"></i>

                                            <strong>Balloon 1</strong>

                                            <small>01 Jan 2017 to 07 Jan 2017</small>

                                            <em>+ <i class="currency-mark">£</i>17.54</em>

                                            <span>Popped!</span>
                                        </a>
                                    </li>
                                </ul><!-- /.list-balloons -->
                            </div><!-- /.widget-body -->
                        </div><!-- /.widget -->
                    </div><!-- /.widgets -->
                </div><!-- /.container -->
            </div><!-- /.section-body section-balloons-scrollable -->
        </section><!-- /.section -->
    </main><!-- /.main main-primary -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>