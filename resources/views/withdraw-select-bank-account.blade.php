@extends('layouts.main')

@section('content')

    <div class="balloon desktop-only" id="balloon">
        <i class="ico-baloon-large"></i>
    </div><!-- /#balloon.balloon.desktop-only -->

    <main class="main" data-show-nav-button="false" data-show-balance-button="true" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" data-show-balloon="true" id="cnt">
        <div class="container">
            <div class="form-funds form-funds-withdraw">
                <form action="withdraw-review-and-confirm" method="post" class="js-form-internal">
                    <div class="form-head">
                        <h1>Withdraw Funds</h1>

                        <p>Select the destination you would like to withdraw funds to and confirm the amount of funds you would like to withdraw.</p>
                    </div><!-- /.form-head -->

                    <div class="form-body">
                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-card" id="select-uphold-card" value="" placeholder="Select Destination" readonly="readonly" data-toggle="modal" data-target="#bank-modal" required>

                                <span class="form-field-value" id="selected-account"><strong></strong></span>

                                <i class="form-row-icon form-row-icon-dots"></i>

                                <label for="select-uphold-card" class="form-label">Selected Destination</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="number" class="field" name="select-uphold-amount" id="select-uphold-amount" value="" placeholder="Amount" required>

                                <span class="form-currency-mark currency-mark">£</span>

                                <span class="form-currency currency">GBP</span>

                                <label for="select-uphold-amount" class="form-label">Amount</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->
                    </div><!-- /.form-body -->

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" disabled id="btn-select-currency">Proceed to Next Step</button>
                    </div><!-- /.form-actions -->
                </form>
            </div><!-- /.form-funds form-funds-withdraw -->
        </div><!-- /.container -->

        <div class="modal" id="bank-modal">
            <div class="modal-inner">
                <div class="modal-head">
                    <h2>Select a Bank Account</h2>

                    <button type="button" class="btn btn-clear modal-close">
                        <i class="ico-add"></i>
                    </button>
                </div><!-- /.modal-head -->

                <div class="modal-body">
                    <ul class="list-accounts">
                        <li>
                            <a href="#" class="js-select-account" data-target="#selected-account">
                                <span>
                                    <small class="currency">GBP</small>
                                </span>

                                <strong>My Checking Account</strong>

                                <small>GBP - Debit Card</small>

                                <i class="ico-star"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="js-select-account" data-target="#selected-account">
                                <span>
                                    <small class="currency">GBP</small>
                                </span>

                                <strong>My Chase Card</strong>

                                <small>GBP - Credit Card</small>

                                <i class="ico-star"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="js-select-account" data-target="#selected-account">
                                <span>
                                    <small class="currency">GBP</small>
                                </span>

                                <strong>Another Example</strong>

                                <small><em class="currency-mark">£</em>0.54 <em class="currency">GBP</em></small>

                                <i class="ico-star"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="js-select-account" data-target="#selected-account">
                                <span>
                                    <small class="currency">GBP</small>
                                </span>

                                <strong>Another Example</strong>

                                <small><em class="currency-mark">£</em>0.54 <em class="currency">GBP</em></small>

                                <i class="ico-star"></i>
                            </a>
                        </li>
                    </ul><!-- /.list-accounts -->
                </div><!-- /.modal-body -->
            </div><!-- /.modal-inner -->
        </div><!-- /#bank-modal.modal -->
    </main><!-- /.main -->

@endsection