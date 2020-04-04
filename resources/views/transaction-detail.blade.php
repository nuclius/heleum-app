@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="false" data-show-balance-button="true" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">
        <section class="section-secondary">
            <header class="section-head">
                <div class="container">
                    <h2>Transaction<span class="desktop-only">s</span> Detail</h2>
                </div><!-- /.container -->
            </header><!-- /.section-head -->

            <div class="section-body">
                <div class="container">
                    <section class="section-review">
                        <header class="section-head">
                            <i class="circle-2 mobile-only"></i>

                            <i class="circle-2-large desktop-only"></i>

                            <h1>You successfully deposited <br><em class="currency-mark">£</em>75.00 <em class="currency">GBP</em> on 01 Jan 2017</h1>
                        </header><!-- /.section-head -->

                        <div class="section-body">
                            <ul class="list-funds">
                                <li>
                                    <span>
                                        <small>GBP</small>
                                    </span>

                                    <em class="funds-withdraw">- <i class="currency-mark">£</i>150.00 <i class="currency">GBP</i></em>

                                    <strong>From My GBP Card</strong>
                                </li>

                                <li>
                                    <span>
                                        <small class="heleum">H<sup>e</sup></small>
                                    </span>

                                    <em class="funds-deposit">+ <i class="currency-mark">£</i>150.00 <i class="currency">GBP</i></em>

                                    <strong>To Your Heleum App</strong>
                                </li>
                            </ul><!-- /.list-funds -->
                        </div><!-- /.section-body -->
                    </section><!-- /.section-review -->
                </div><!-- /.container -->
            </div><!-- /.section-body -->
        </section><!-- /.section-secondary -->
    </main><!-- /.main main-primary -->



@endsection