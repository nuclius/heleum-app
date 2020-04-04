@extends('layouts.main')

@section('content')

    @include('partials.balloon')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" data-show-balloon="true" id="cnt">
        <div class="container">
            <div class="form-funds">

                @include('partials.error-alert')

                <form action="review-and-confirm" method="post" class="xjs-form-internal">
                    {{ csrf_field() }}
                    <div class="form-head">
                        <h1>Add Funds</h1>
                    </div><!-- /.form-head -->

                    <div class="form-body">
                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-card" id="select-uphold-card" value="" placeholder="Select Uphold Card" readonly="readonly" data-toggle="modal" data-target="#card-modal" required>

                                <span class="form-field-value" id="selected-card"><strong></strong> <small></small></span>

                                <i class="form-row-icon form-row-icon-dots"></i>

                                <label for="select-uphold-card" class="form-label">Selected Card</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-amount" id="select-uphold-amount" value="" placeholder="Amount" data-validate="min" required>

                                <span class="form-currency-mark currency-mark"></span>

                                <span class="form-currency currency"></span>

                                <label for="select-uphold-amount" class="form-label">Amount</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <p>Minimum Amount: {{ Auth::user()->getBaseCurrencySymbol() }}{{ Auth::user()->getMinimumAddFundsAmount() }} {{ Auth::user()->getBaseCurrency() }}</p>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->
                    </div><!-- /.form-body -->

                    <div class="form-actions">
                        <input type="hidden" name="selected-card-id" id="selected-card-id" value="" required="required" />
                        <input type="hidden" name="selected-currency" id="selected-currency" value="" required="required" />

                        <button type="submit" class="btn btn-primary" disabled id="btn-select-currency">Proceed to Next Step</button>
                    </div><!-- /.form-actions -->
                </form>

                <div class="modal" id="card-modal">
                    <div class="modal-inner">
                        <div class="modal-head">
                            <h2>Select an Uphold Card</h2>

                            <button type="button" class="btn btn-clear modal-close">
                                <i class="ico-add"></i>
                            </button>
                        </div><!-- /.modal-head -->

                        <div class="modal-body">
                            <ul class="list-accounts">
                                @foreach ($cards as $card)
                                    @include('partials.card', ['card' => $card])
                                @endforeach
                            </ul><!-- /.list-accounts -->
                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-inner -->
                </div><!-- /#card-modal.modal -->
            </div><!-- /.form-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection