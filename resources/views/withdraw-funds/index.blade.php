@extends('layouts.main')

@section('content')

    @include('partials.balloon')

    <main class="main"
        data-show-nav-button="true"
        data-show-balance-button="true"
        data-show-back-button="false"
        data-show-balloon="true"
        id="cnt"
        >
        <div class="container">
            <section class="section-funds">
                <header class="section-head">
                    <h1>@lang('Withdraw Funds')</h1>

                    {{-- <p>@lang('Bank transfers can take 5-7 days to complete')</p> --}}
                </header><!-- /.section-head -->

                <div class="section-actions">
                    <a href="/withdraw-funds/uphold" class="btn btn-primary js-link-internal">@lang('To Uphold Card')</a>

                    {{-- <span class="btn btn-primary">@lang('Bank Account Coming Soon!')</span> --}}
                </div><!-- /.section-actions -->
            </section><!-- /.section-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection