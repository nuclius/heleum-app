@extends('layouts.main')

@section('content')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review">
                <header class="section-head">
                    <i class="circle-3 mobile-only"></i>

                    <i class="circle-3-large desktop-only"></i>

                    <h1>@lang('You are Withdrawing') <br><em class="currency-mark">{{ $currencyMark }}</em>{{ $amount }} <em class="currency">{{ $currency }}</em> from Your Account</h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <ul class="list-funds">
                        <li>
                            <span>
                                <small class="heleum">H<sup>e</sup></small>
                            </span>

                            <em class="funds-withdraw">- <i class="currency-mark">{{ $currencyMark }}</i>{{ $amount }} <i class="currency">{{ $currency }}</i></em>

                            <strong>@lang('From My Heleum Account')</strong>
                        </li>

                        <li>
                            <span>
                                <small>{{ $currency }}</small>
                            </span>

                            <em class="funds-deposit">+ <i class="currency-mark">{{ $currencyMark }}</i>{{ $amount }} <i class="currency">{{ $currency }}</i></em>

                            <strong>To My {{ $cardName }}</strong>
                        </li>
                    </ul><!-- /.list-funds -->
                </div><!-- /.section-body -->

                <footer class="section-foot">
                    <form action="transfer-funds" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="amount" value="{{ $amount }}" required="required">
                        <input type="hidden" name="selected-card-id" value="{{ $cardId }}" required="required">
                        <input type="hidden" name="currencyMark" value="{{ $currencyMark }}" required="required">
                        <input type="hidden" name="currency" value="{{ $currency }}" required="required">

                        <button type="submit" class="btn btn-primary">@lang('Complete Transaction')</button>
                    </form>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection