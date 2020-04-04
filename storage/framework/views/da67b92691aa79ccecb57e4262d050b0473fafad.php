<?php $__env->startSection('content'); ?>

    <main class="main main-primary" data-show-nav-button="false" data-show-balance-button="true" data-show-back-button="true" data-back-url="account-overview" data-back-text="Heleum Overview" id="cnt">
        <div class="socials socials-alt">
            <div class="container">
                <span>Share With Friends:</span>

                <a href="#" class="socials-facebook">
                    <i class="ico-facebook"></i>
                </a>

                <a href="#" class="socials-twitter">
                    <i class="ico-twitter"></i>
                </a>
            </div><!-- /.container -->
        </div><!-- /.socials socials-alt -->

        <div class="container">
            <section class="section-popped section-popped--alt">
                <header class="section-head">
                    <h1>Balloon 1 Popped!</h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <ul class="list-balloon-details">
                        <li>Launched 7 Jan 2017 <span><em class="currency-mark">£</em>15.00 <em class="currency">GBP</em></span></li>

                        <li>Popped 18 Jan 2017 <span><em class="currency-mark">£</em>19.26 <em class="currency">GBP</em></span></li>

                        <li>Your Share <span class="mark"><em class="currency-mark">£</em>2.56 <em class="currency">GBP</em></span></li>

                        <li>Heleum’s Share <span><em class="currency-mark">£</em>1.70 <em class="currency">GBP</em></span></li>
                    </ul><!-- /.list-balloon-details -->
                </div><!-- /.section-body -->
            </section><!-- /.section-popped -->
        </div><!-- /.container -->

        <section class="section">
            <div class="section-body">
                <div class="chart">
                    <span class="mobile-only" style="height: 216px; background: url(css/images/temp/chart1-mobile.jpg) no-repeat 0 50% / cover;"></span>

                    <span class="desktop-only" style="height: 400px; background: url(css/images/temp/chart1-desktop.jpg) no-repeat 0 50% / cover;"></span>
                </div><!-- /.chart -->
            </div><!-- /.section-body -->
        </section><!-- /.section -->

        <section class="section">
            <header class="section-head-primary section-head-primary-reverse">
                <div class="container">
                    <h3>Launch Amount: <strong><em class="currency-mark">£</em>15.00</strong></h3>

                    <h4>Current Amount: <strong><em class="currency-mark">£</em>17.54</strong></h4>
                </div><!-- /.container -->
            </header><!-- /.section-head-primary section-head-primary-reverse -->

            <div class="section-body section-transactions-scrollable">
                <div class="container">
                    <div class="widgets">
                        <div class="widget widget-wide">
                            <ul class="list-transactions">
                                <li>
                                    <p>Bought 1.31 <em class="currency">USD</em> with 1.65 CAD <small>01 Jan 2017 at 13:54</small></p>

                                    <strong><em class="currency-mark">£</em>17.54</strong>
                                </li>

                                <li>
                                    <p>Bought 1.31 <em class="currency">USD</em> with 1.65 CAD <small>01 Jan 2017 at 13:54</small></p>

                                    <strong><em class="currency-mark">£</em>17.21</strong>
                                </li>

                                <li>
                                    <p>Bought 1.31 <em class="currency">USD</em> with 1.65 CAD <small>01 Jan 2017 at 13:54</small></p>

                                    <strong><em class="currency-mark">£</em>16.92</strong>
                                </li>

                                <li>
                                    <p>Bought 1.31 <em class="currency">USD</em> with 1.65 CAD <small>01 Jan 2017 at 13:54</small></p>

                                    <strong><em class="currency-mark">£</em>15.78</strong>
                                </li>
                            </ul><!-- /.list-transactions -->
                        </div><!-- /.widget widget-wide -->
                    </div><!-- /.widgets -->
                </div><!-- /.container -->
            </div><!-- /.section-body section-transactions-scrollable -->
        </section><!-- /.section -->
    </main><!-- /.main main-primary -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>