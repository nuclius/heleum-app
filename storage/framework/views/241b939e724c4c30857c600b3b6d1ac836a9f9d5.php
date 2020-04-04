<?php $__env->startSection('content'); ?>

    <header class="header">
        <div class="container">
            <button type="button" class="btn btn-clear hidden" id="nav-open">
                <i class="ico-burger"></i>

                <small class="desktop-only">Menu</small>
            </button>

            <a href="#" class="btn btn-clear hidden" id="btn-back" role="button">
                <i class="ico-back"></i>

                <small class="desktop-only"></small>
            </a>

            <span class="logo">
                <img src="/css/images/logo@2x.png" alt="Heleum Brand Image" >
            </span>

            <span class="btn-clear hidden" id="btn-balance">
                <a href="transactions" class="js-link-internal"><em class="currency-mark">£</em>152.54</a>

                <a href="/add-funds" class="js-link-internal">
                    <i class="ico-add"></i>
                </a>
            </span>
        </div><!-- /.container -->
    </header><!-- /.header -->


    <main class="main main-primary" data-show-nav-button="false" data-show-balance-button="true" data-show-back-button="true" data-back-url="account-overview" data-back-text="Heleum Overview" id="cnt">
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
                    <h3>Launch Amount: <strong><span class="currency-mark">£</span>15.00</strong></h3>

                    <h4>Current Amount: <strong><span class="currency-mark">£</span>17.54</strong></h4>
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