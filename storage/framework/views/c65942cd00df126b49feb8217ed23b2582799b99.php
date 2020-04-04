<?php $__env->startSection('content'); ?>

    


        <div class="balloon" id="balloon">
            <i class="ico-baloon-large desktop-only"></i>

            <i class="ico-baloon mobile-only"></i>
        </div><!-- /#balloon.balloon -->

        <main class="main"
            data-show-nav-button="false"
            data-show-balance-button="false"
            data-show-back-button="false"
            data-show-balloon="true"
            id="cnt">
            <div class="container">
                <div class="form-currency">
                    <form action="/add-funds" method="post" class="js-form-internal">
                        <div class="form-head">
                            <h1>Select your base currency</h1>

                            <p>You’ll only be able to transfer funds into the app from a card that matches your base currency.</p>
                        </div><!-- /.form-head -->

                        <div class="form-body">
                            <ul class="list-radios">
                                <li>
                                    <div class="radio">
                                        <input type="radio" name="currency" id="currency-usd" value="usd" class="js-radio">

                                        <label for="currency-usd">usd</label>
                                    </div><!-- /.radio -->
                                </li>

                                <li>
                                    <div class="radio">
                                        <input type="radio" name="currency" id="currency-gbp" value="gbp" class="js-radio">

                                        <label for="currency-gbp">gbp</label>
                                    </div><!-- /.radio -->
                                </li>

                                <li>
                                    <div class="radio">
                                        <input type="radio" name="currency" id="currency-eur" value="eur" class="js-radio">

                                        <label for="currency-eur">eur</label>
                                    </div><!-- /.radio -->
                                </li>
                            </ul><!-- /.list-radios -->
                        </div><!-- /.form-body -->

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" disabled id="btn-select-currency">Confirm Selection</button>
                        </div><!-- /.form-actions -->
                    </form>
                </div><!-- /.form-currency -->
            </div><!-- /.container -->
        </main><!-- /.main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.loggedout-main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>