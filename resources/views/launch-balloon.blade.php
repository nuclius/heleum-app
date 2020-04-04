@extends('layouts.main')

@section('content')

    <main class="main" data-show-nav-button="false" data-show-balance-button="false" data-show-back-button="false" id="cnt">
        <div class="container">
            <section class="section-review section-launch">
                <header class="section-head">
                    <h1>Launch Your First Balloon</h1>

                    <p>Launch your first balloon to start earning money with Heleum. After your first balloon is launched, Heleum will launch new balloons automatically.</p>
                </header><!-- /.section-head -->

                <footer class="section-foot">
                    <i class="ico-baloon mobile-only"></i>

                    <i class="ico-baloon-large desktop-only"></i>

                    <a href="balloon-launched" class="btn btn-primary js-link-internal">Launch First Balloon</a>
                </footer><!-- /.section-foot -->
            </section><!-- /.section-review section-launch -->
        </div><!-- /.container -->
    </main><!-- /.main -->


@endsection