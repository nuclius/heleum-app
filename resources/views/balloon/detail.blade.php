@extends('layouts.main')

@section('content')

    <main class="main main-primary"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        id="cnt"
        >

        <div class="container">
            <section class="section-popped section-popped--alt">
                <header class="section-head">
                    <h1>@lang('Balloon') {{ $balloon->user_balloon_id }} @if ($balloon->isPopped()) @lang('Popped!') @endif</h1>
                </header><!-- /.section-head -->
            </section>
        </div>

        @if ($balloon->isPopped())
            {{--
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
            --}}

            <div class="container">
                <section class="section-popped section-popped--alt">
                    <div class="section-body">
                        <ul class="list-balloon-details">
                            <li>@lang('Launched') {{ $balloon->getStartDate('j M Y') }} <span><em class="currency-mark">{{ $balloon->getLaunchCurrencyMark() }}</em>{{ number_format($balloon->getlaunchAmount(), 2) }} <em class="currency">{{ $balloon->getLaunchCurrency() }}</em></span></li>

                            <li>@lang('Popped') {{ $balloon->getEndDate('j M Y') }} <span><em class="currency-mark">{{ $balloon->getCurrentCurrencyMark() }}</em>{{ number_format($balloon->getCurrentAmount(), 2) }} <em class="currency">{{ $balloon->getCurrentCurrency() }}</em></span></li>

                            <li>@lang('Your Share') <span class="mark"><em class="currency-mark">{{ $balloon->pop->getCurrencyMark() }}</em>{{ number_format($balloon->pop->getGains(), 2) }} <em class="currency">{{ $balloon->pop->getCurrency() }}</em></span></li>

                            <li>@lang('Heleum&rsquo;s Share') <span><em class="currency-mark">{{ $balloon->pop->getCurrencyMark() }}</em>{{ number_format($balloon->pop->heleum_fee_amount, 2) }} <em class="currency">{{ $balloon->pop->getCurrency() }}</em></span></li>
                        </ul><!-- /.list-balloon-details -->
                    </div><!-- /.section-body -->
                </section><!-- /.section-popped -->
            </div><!-- /.container -->
        @endif

        {{-- Hiding Charts for now
        <section class="section">
            <div class="section-body">
                <div class="chart">
                    <span class="mobile-only" style="height: 216px; background: url(css/images/temp/chart1-mobile.jpg) no-repeat 0 50% / cover;"></span>

                    <span class="desktop-only" style="height: 400px; background: url(css/images/temp/chart1-desktop.jpg) no-repeat 0 50% / cover;"></span>
                </div>
            </div>
        </section>
        --}}

        <section class="section">
            <header class="section-head-primary section-head-primary-reverse">
                <div class="container">
                    @if ($balloon->hasMoves())
                        <h3>@lang('Launch Amount:') <strong>&nbsp;&nbsp;<span class="currency-mark">{{ $balloon->getLaunchCurrencyMark() }}</span>{{ number_format($balloon->getlaunchAmount(), 2) }}</strong></h3>

                        <h4>@lang('Current Amount:') <strong>&nbsp;&nbsp;<span class="currency-mark">{{ $balloon->getCurrentCurrencyMark() }}</span>{{ number_format($balloon->getCurrentAmount(), 2) }}</strong></h4>
                    @else
                        <h3>@lang('Waiting to Launch:') <strong>&nbsp;&nbsp;<span class="currency-mark">{{ $balloon->getLaunchCurrencyMark() }}</span>{{ number_format($balloon->getlaunchAmount(), 2) }}</strong></h3>
                    @endif
                </div><!-- /.container -->
            </header><!-- /.section-head-primary section-head-primary-reverse -->

            @if ($balloon->hasMoves())
            <div class="section-body section-transactions-scrollable">
                <div class="container">
                    <div class="widgets">
                        <div class="widget widget-wide">
                            <ul class="list-transactions">
                                @foreach ($balloon->transactions as $txn)
                                    @include('balloon.transaction', ['txn' => $txn])
                                @endforeach
                            </ul><!-- /.list-transactions -->

                            @if ($balloon->isActive())
                                <p>The initial value of the balloon at launch includes an Uphold conversion fee. Balloons can remain active for 30-90 days and fluctuate significantly in value before popping at a gain.</p>
                            @endif

                        </div><!-- /.widget widget-wide -->
                    </div><!-- /.widgets -->
                </div><!-- /.container -->
            </div><!-- /.section-body section-transactions-scrollable -->
            @endif
        </section><!-- /.section -->
    </main><!-- /.main main-primary -->


@endsection