@extends('layouts.main')

@section('content')

    <main class="main" data-show-nav-button="false" data-show-balance-button="true" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">
        <div class="container">
            <section class="section-review section-review-withdraw">
                <header class="section-head">
                    <i class="circle-2 mobile-only"></i>

                    <i class="circle-2-large desktop-only"></i>

                    <h1>You have withdrawn <br><em class="currency-mark">£</em>75.00 <em class="currency">GBP</em></h1>
                </header><!-- /.section-head -->

                <div class="section-body">
                    <ul class="list-funds">
                        <li>
                            <span>
                                <small class="heleum">H<sup>e</sup></small>
                            </span>

                            <em class="funds-withdraw">- <i class="currency-mark">£</i>60.00 <i class="currency">GBP</i></em>

                            <strong>From Your Heleum App</strong>
                        </li>

                        <li>
                            <span>
                                <small class="heleum">H<sup>e</sup></small>
                            </span>

                            <em class="funds-withdraw">- <i class="currency-mark">£</i>15.00 <i class="currency">GBP</i></em>

                            <strong>From Active Balloons</strong>
                        </li>

                        <li>
                            <span>
                                <small>GBP</small>
                            </span>

                            <em class="funds-deposit">+ <i class="currency-mark">£</i>75.00 <i class="currency">GBP</i></em>

                            <strong>To My Checking Account</strong>
                        </li>
                    </ul><!-- /.list-funds -->
                </div><!-- /.section-body -->

                <footer class="section-foot">
                    <a href="account-overview" class="btn btn-primary js-link-internal">Account Overview</a>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review section-review-withdraw -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection