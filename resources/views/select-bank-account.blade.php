@extends('layouts.main')

@section('content')

    @include('partials.balloon')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" data-show-balloon="true" id="cnt">
        <div class="container">
            <div class="form-funds">
                <form action="review-and-confirm" method="post" class="js-form-internal">
                    <div class="form-head">
                        <h1>Add Funds</h1>
                    </div><!-- /.form-head -->

                    <div class="form-body">
                        <div class="form-notice">
                            <i class="ico-alert"></i>

                            Please add a minimum of $50, €75, or £100.
                        </div><!-- /.form-notice -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-card" id="select-uphold-card" value="" placeholder="Select a Bank Account" readonly="readonly" data-toggle="modal" data-target="#bank-modal" required>

                                <span class="form-field-value" id="selected-account"><strong></strong></span>

                                <i class="form-row-icon form-row-icon-dots"></i>

                                <label for="select-uphold-card" class="form-label">Selected Bank Account</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="number" class="field" name="select-uphold-amount" id="select-uphold-amount" value="" placeholder="Amount" data-validate="min" required>

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

                                        <small><em class="currency">GBP</em> - Debit Card</small>

                                        <i class="ico-star"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="js-select-account" data-target="#selected-account">
                                        <span>
                                            <small class="currency">GBP</small>
                                        </span>

                                        <strong>My Chase Card</strong>

                                        <small><em class="currency">GBP</em> - Debit Card</small>

                                        <i class="ico-star"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="js-select-account" data-target="#selected-account">
                                        <span>
                                            <small class="currency">GBP</small>
                                        </span>

                                        <strong>Another Example</strong>

                                        <small><em class="currency">GBP</em> - Debit Card</small>

                                        <i class="ico-star"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="js-select-account" data-target="#selected-account">
                                        <span>
                                            <small class="currency">GBP</small>
                                        </span>

                                        <strong>Another Example</strong>

                                        <small><em class="currency">GBP</em> - Debit Card</small>

                                        <i class="ico-star"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="add-account">
                                        <span>
                                            <small></small>
                                        </span>

                                        <strong>Add Bank Account</strong>
                                    </a>
                                </li>
                            </ul><!-- /.list-accounts -->
                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-inner -->
                </div><!-- /#bank-modal.modal -->
            </div><!-- /.form-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection