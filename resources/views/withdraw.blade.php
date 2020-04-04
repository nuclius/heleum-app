@extends('layouts.main')

@section('content')

    @include('partials.balloon')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-show-balloon="true" id="cnt">
        <div class="container">
            <section class="section-funds">
                <header class="section-head">

                    <h1>Withdraw Funds</h1>

                    <p>Bank transfers can take 5-7 days to complete</p>
                </header><!-- /.section-head -->

                <div class="section-actions">
                    <a href="withdraw-select-uphold-card" class="btn btn-primary js-link-internal">To Uphold Card</a>

                    <a href="withdraw-select-bank-account" class="btn btn-primary js-link-internal">To Bank Account</a>
                </div><!-- /.section-actions -->
            </section><!-- /.section-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection