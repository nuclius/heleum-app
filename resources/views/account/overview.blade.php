@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="true" data-show-back-button="false" id="cnt">
        <section class="section">
            
            <header class="section-head" style="display: none">
                <div class="container">
                    @if (Auth::user()->isVerified())
                        <div style="float:right;">
                            <a href="/add-funds" style="text-decoration:underline;">ADD FUNDS</a>

                            &nbsp;&nbsp;

                            <a href="/withdraw-funds" style="text-decoration:underline;">WITHDRAW</a>
                        </div>
                    @endif

                    <h2 class="section-title">@lang('Account Overview')</h2><!-- /.section-title -->

                    {{--  Change view not working, since Statistics isn't in place now
                    <div class="section-head-actions">
                        <span class="desktop-only">Change View:</span>

                        <a href="#weekly-statistics" data-toggle="tab" role="button" class="btn btn-secondary current">Weekly</a>

                        <a href="#monthly-statistics" data-toggle="tab" role="button" class="btn btn-secondary">Monthly</a>
                    </div>
                    --}}
                </div>
            </header>

            {{--  Statistics Section Commented out for now
            <div class="section-body">
                <div class="tabs">
                    @include('account.statistics')
                </div>
            </div>
            --}}
        </section>

        <section class="section">
            <header class="section-head-primary overview-row">
                <div class="container">
                    <div class="row">
                        <div class="overview-entry four columns text-left">
                            @lang('Balance: ') <strong><i class="currency-mark">{{ $currencyMark }}</i>{{ number_format($balance, 2) }} {{ $currency }}</strong>
                        </div>

                        <div class="overview-entry four columns text-center">
                            @lang('In Balloons: ') <strong><i class="currency-mark">{{ $currencyMark }}</i>{{ number_format($activeBalloonAmounts, 2) }} {{ $currency }}</strong>
                        </div>

                        <div class="overview-entry four columns text-right">
                            @lang('Not In Balloons: ') <strong><i class="currency-mark">{{ $currencyMark }}</i>{{ number_format($notInBalloons, 2) }} {{ $currency }}</strong>
                        </div>
                    </div>
                    {{-- <h4>@lang('Past 7 Days:') <strong>{{ $performance7DaySymbol }} <i class="currency-mark">{{ Auth::user()->getBaseCurrencySymbol() }}</i>{{ Auth::user()->getperformance7Day }} <em class="currency">{{ $currency }}</em></strong></h4> --}}
                </div><!-- /.container -->
            </header><!-- /.section-head-primary -->

            <div class="section-body section-balloons-scrollable">
                <div class="container">
                    @if (Auth::user()->isVerified())
                        <div class="widgets">
                            <div class="widget widget-expanded">
                                @include('account.balloons-active', ['balloons' => $activeBalloons])
                            </div><!-- /.widget -->

                            <div class="widget">
                                @include('account.balloons-popped', ['balloons' => $poppedBalloons])
                            </div><!-- /.widget -->
                        </div><!-- /.widgets -->
                        <div class="large-top-spacing">
                            <div class="eight columns alert" style="background-color: #99ddff">
                                <p>Heleum is currently paused while we develop Version 3.0. <a class="underline" href="https://heleum.com/heleum-paused">Learn More here.</a></p>
                            </div>
                        </div>
                    @else
                        <div class="large-top-spacing">
                            <div class="two columns">&nbsp;</div>
                            <div class="eight columns alert" style="background-color: #99ddff">
                                @if (Auth::user()->isPhpBrownbag())
                                    <p>Welcome to Heleum, Lambda School!</p>
                                @else
                                    <p>Heleum is currently paused while we develop Version 3.0. <a class="underline" href="https://heleum.com/heleum-paused">Learn More here.</a></p>
                                    {{--
                                    <h3>Getting Started</h3>
                                    <p>Get Verified on Uphold with your legal name and photo ID so you can add funds.</p>
                                    
                                    <h3><a class="btn btn-primary" href="https://uphold.com/dashboard/membership/" target="_blank">Get verified HERE</a></h3>
                                    <br/>
                                    <p>For more information on Uphold verification, see <a class="underline" href="https://support.uphold.com/hc/en-us/articles/206119603">Uphold Support</a>.</p>
                                    --}}
                                @endif
                            </div><!-- /.notice -->
                        </div>
                    @endif
                </div><!-- /.container -->
            </div><!-- /.section-body section-balloons-scrollable -->
        </section><!-- /.section -->
    </main><!-- /.main main-primary -->

@endsection