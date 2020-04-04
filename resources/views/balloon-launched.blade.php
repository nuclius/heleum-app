@extends('layouts.main')

@section('content')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review section-launch section-launched">
                <header class="section-head">
                    <i class="ico-baloon-large"></i>

                    <h1>First Balloon Launched!</h1>

                    <p>Balloon 1 has launched, with 5% of your Heleum funds (<em class="currency-mark"></em>15.00 <em class="currency">GBP</em>). We'll let you know when it's ready to pop.</p>
                </header><!-- /.section-head -->

                <footer class="section-foot">
                    <a href="active-balloon-detail" class="btn btn-primary js-link-internal">View Balloon</a>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review section-launch section-launched -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection