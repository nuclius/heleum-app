@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">
        <section class="section-primary">
            <header class="section-head">
                <div class="container">
                    <h1>Boosts</h1>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-boosts">
                        <li>
                            <p>
                                <span>Share of Gains</span>
                            </p>

                            <p>50% <strong> + 10%</strong></p>
                        </li>

<!--                         <li>
                            <p>Boost</p>

                            <p>Active until 15 Jun 2017</p>
                        </li> -->
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
                            <p>Refer friends</p>

                            <div class="socials">
                                <a href="#" class="socials-facebook">
                                    <!-- https://developers.facebook.com/docs/plugins/share-button/# -->
                                    <i class="ico-facebook"></i>
                                </a>

                                <a href="#" class="socials-twitter">
                                    <!-- https://dev.twitter.com/web/tweet-button -->
                                    <i class="ico-twitter"></i>
                                </a>

                                <p>
                                    <span>heleum.com/r/{{ referral_code }}</span>
                                </p>

                                <a href="#" id="copy-link" class="socials-copy">
                                    <span>Copy Link</span>

                                    <span>Copied <small></small></span>
                                </a>
                            </div><!-- /.socials -->
                        </li>
                    </ul><!-- /.list-boosts -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->

            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">Active Boosts</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <ul class="list-referrals">
                        @foreach ($user->boosts as $boost)
                            @include('user.boost', ['boost' => $boost])
                        @endforeach
<!--                         <li>
                            <p>Referred danwebb</p>

                            <a href="#" class="btn btn-secondary btn-secondary-active">Activate</a>
                        </li>

                        <li>
                            <p>Referred mfryers</p>

                            <a href="#" class="btn btn-secondary btn-secondary-active">Activate</a>
                        </li>

                        <li>
                            <p>Referred danwebb</p>

                            <a href="#" class="btn btn-secondary btn-secondary-active">Activate</a>
                        </li>

                        <li>
                            <p>Referred mfryers</p>

                            <a href="#" class="btn btn-secondary btn-secondary-active">Activate</a>
                        </li> -->
                    </ul><!-- /.list-referrals -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->
        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->


@endsection