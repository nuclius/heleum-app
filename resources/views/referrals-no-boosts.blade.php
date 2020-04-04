@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" id="cnt">
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

                            <p>60% <strong> + 0%</strong></p>
                        </li>

                        <li>
                            <p>Referral Boost</p>

                            <p>No Boost Active</p>
                        </li>
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
                                    <i class="ico-facebook"></i>
                                </a>

                                <a href="#" class="socials-twitter">
                                    <i class="ico-twitter"></i>
                                </a>

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
                    <h2 class="section-title">Available Boosts <small>Activating adds 30 days to +10% Referral Boost</small></h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <div class="section-entry">
                        <p>Refer more friends!</p>
                    </div><!-- /.section-entry -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->
        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->


@endsection