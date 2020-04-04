@extends('layouts.main')

@section('content')

    @include('partials.balloon')

    <main class="main"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        data-show-balloon="true"
        id="cnt"
        >
        <div class="container">
            <div class="form-funds">

                @include('partials.error-alert')

                <form action="review-and-confirm" method="post" class="xjs-form-internal">
                    {{ csrf_field() }}
                    <div class="form-head">
                        <h1>@lang('Withdraw Funds')</h1>
                        <h3>@lang('Your account balance is: ') <span class="currency-mark">{{ $currencyMark }}</span>{{ number_format($user->getBalance(), 2) }} {{ $currency }}
                    </div><!-- /.form-head -->

                    <div class="form-body">
                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-card" id="select-uphold-card" value="" placeholder="Select Uphold Card" readonly="readonly" data-toggle="modal" data-target="#card-modal" required>

                                <span class="form-field-value" id="selected-card"><strong></strong> <small></small></span>

                                <i class="form-row-icon form-row-icon-dots"></i>

                                <label for="select-uphold-card" class="form-label">@lang('Selected Card')</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <div class="form-row">
                            <div class="form-controls">
                                <input type="text" class="field" name="select-uphold-amount" id="select-uphold-amount" value="" placeholder="Amount" required> <!-- data-validate="min" -->

                                <span class="form-currency-mark currency-mark"></span>

                                <span class="form-currency currency"></span>

                                <label for="select-uphold-amount" class="form-label">@lang('Amount')</label>
                            </div><!-- /.form-controls -->
                        </div><!-- /.form-row -->

                        <p class="alert" style="text-align: center;">
                            <strong>NOTE:</strong> Withdrawing may pop active balloons.
                        </p>
                    </div><!-- /.form-body -->

                    <div class="form-actions">
                        <input type="hidden" name="selected-card-id" id="selected-card-id" value="" required="required" />
                        <input type="hidden" name="selected-currency" id="selected-currency" value="" required="required" />

                        <button type="submit" class="btn btn-primary" disabled id="btn-select-currency">@lang('Proceed to Next Step')</button>
                    </div><!-- /.form-actions -->
                </form>

                <div class="modal" id="card-modal">
                    <div class="modal-inner">
                        <div class="modal-head">
                            <h2>@lang('Select an Uphold Card')</h2>

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