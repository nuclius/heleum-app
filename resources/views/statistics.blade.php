@inject('currencyService', 'App\Services\CurrencyService')

@extends('layouts.main')

@section('content')

    <main class="main main-primary"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        id="cnt"
        >
        <section class="section-secondary">
            <header class="section-head">
                <div class="container">
                    <h2>@lang('Account Statistics')</h2>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-statistics">
                        <li>@lang('Account Balance') <span><em class="currency-mark">{{ $currencyService::convertCurrencyToMark($user->getBaseCurrency()) }}</em>{{ number_format(abs($user->getBalance()), 2) }}</span></li>

                        <li>@lang('Popped Balloon Gains') <span class="mark {{ ($gainAmount < 0.00) ? 'negative' : '' }}">{{ ($gainAmount >= 0.00) ? '+' : '-' }}<em class="currency-mark">{{ $currencyService::convertCurrencyToMark($user->getBaseCurrency()) }}</em>{{ number_format(abs($gainAmount), 2) }}</span></li>

                        <li>@lang('Active Balloon Gains') <span class="mark {{ ($unrealizedAmount < 0.00) ? 'negative' : '' }}">{{ ($unrealizedAmount >= 0.00) ? '+' : '-' }}<em class="currency-mark">{{ $currencyService::convertCurrencyToMark($user->getBaseCurrency()) }}</em>{{ number_format(abs($unrealizedAmount), 2) }}</span></li>

                        <li>@lang('Balloons Launched') <span>{{ count($user->activeBalloons()) }}</span></li>

                        <li>@lang('Balloons Popped') <span>{{ count($user->poppedBalloons()) }}</span></li>
                    </ul><!-- /.list-statistics -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->

<!--             <div class="section-icon">
                <i class="ico-baloon mobile-only"></i>

                <i class="ico-baloon-large desktop-only"></i>
            </div> -->
        </section><!-- /.section-secondary -->
    </main><!-- /.main main-primary -->

@endsection