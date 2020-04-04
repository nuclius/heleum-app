@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">
        <section class="section-primary">
            <header class="section-head">
                <div class="container">
                    <h1>@lang('Boosts')</h1>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-boosts">
                        <li>
                            <p>
                                <span>@lang('Share of Gains')</span>
                            </p>


                            <p>60% @if ($user->hasBoosts())<strong> + {{ $boostPercentage }}%</strong>@endif</p>
                        </li>

                        <!-- NO ACTIVATED BOOSTS AT THIS MOMENT
                        <li>
                            <p>Boost</p>

                            <p>Active until 15 Jun 2017</p>
                        </li>
                        -->
                    </ul><!-- /.list-boosts -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->

            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">Earn Boosts</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-boosts">
                        <li>
                            <p>@lang('Refer friends')</p>

     {{--                        <div class="socials">
                                @inject('socialService', 'App\Services\SocialService')

                                <a href="{{ $socialService::facebookShareUrl() }}" class="socials-facebook">
                                    <!-- https://developers.facebook.com/docs/plugins/share-button/# -->
                                    <i class="ico-facebook"></i>
                                </a>

                                <a href="{{ $socialService::twitterShareUrl() }}" class="socials-twitter">
                                    <!-- https://dev.twitter.com/web/tweet-button -->
                                    <i class="ico-twitter"></i>
                                </a>
                            </div><!-- /.socials --> --}}
                        </li>
                        <li>
                            <p>Your referral link: <strong>{{ $user->referralCodeUrl() }}</strong></p>

                            <div class="socials">
                                <button data-url="{{ $user->referralCodeUrl() }}" id="copy-link" class="socials-copy">

                                    <span>Copy Link</span>

                                    <span>Copied <small></small></span>
                                </button>
                            </div><!-- /.socials -->
                        </li>
                        <li>
                            <p>For each user you refer that is active for 30 days you'll get a 1% Boost to your Gains! (Up to {{ Auth::user()->hasBetaBoost() ? 40 : 20 }} users)</p>
                        </li>
                    </ul><!-- /.list-boosts -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->



            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">@lang('Active Boosts')</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->
            <div class="section-body">
                <div class="container">
                    <ul class="list-referrals">
                        @foreach ($user->boosts as $boost)
                            @include('boosts.boost', ['boost' => $boost])
                        @endforeach
                    </ul><!-- /.list-referrals -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->



            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">@lang('Pending Boosts')</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->
            <div class="section-body">
                <div class="container">
                    <div class="row">
                        @php
                        $referrals = $user->pendingBoosts();
                        if ($referrals->count() > 0) {
                            @endphp
                            <ul class="list-referrals">
                                @foreach ($referrals as $referral)
                                    @include('boosts.pending', ['referral' => $referral])
                                @endforeach
                            </ul><!-- /.list-referrals -->
                            @php
                        } else {
                            @endphp
                            No Pending Boosts
                            @php
                        }
                        @endphp
                    </div>
                    <div class="row">
                        <p>If you aren't seeing someone you referred, please <a href="https://support.heleum.com/new" class="" target="_blank">contact support</a>.</p>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.section-body -->


        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->


@endsection