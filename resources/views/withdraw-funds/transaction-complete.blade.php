@extends('layouts.main')

@section('content')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review">
                <header class="section-head">
                    <i class="circle-2 mobile-only"></i>

                    <i class="circle-2-large desktop-only"></i>
                    <h1>Withdrawal request submitted for <i class="currency-mark">{{ session('currencyMark') }}</i>{{ session('amount') }} <i class="currency">{{ session('currency') }}</i></h1>
                    <h1>@lang('If pending for longer than 30 minutes, please contact support@heleum.com.')</h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <ul class="list-funds">
                        <li>
                            <span>
                                <small class="heleum">H<sup>e</sup></small>
                            </span>

                            <em class="funds-withdraw">- <i class="currency-mark">{{ session('currencyMark') }}</i>{{ session('amount') }} <i class="currency">{{ session('currency') }}</i></em>

                            <strong>@lang('From Your Heleum App') - <small>Debit</small></strong>
                        </li>

                        <li>
                            <span>
                                <small>{{ session('currency') }}</small>
                            </span>

                            <em class="funds-deposit">+ <i class="currency-mark">{{ session('currencyMark') }}</i>{{ session('amount') }} <i class="currency">{{ session('currency') }}</i></em>

                            <strong>@lang('To Your') {{ session('cardName') }}</strong>
                        </li>
                    </ul><!-- /.list-funds -->
                </div><!-- /.section-body -->

                <footer class="section-foot">
                    <a href="/account" class="btn btn-primary js-link-internal">@lang('Continue')</a>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection