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
                    <h1>@lang('Add Funds')</h1>
                    <br/>
                    
                    <p>@lang('Heleum is currently paused while we develop Version 3.0. Learn more here: <a class="underline" href="https://heleum.com/heleum-paused/">heleum.com/heleum-paused</a>')</p>
                    {{--<p>@lang('Heleum is free for accounts under 100 USD. Above that, Heleum charges a low monthly fee of 0.1% per month, with a minimum of 3 USD.')</p>--}}
                </header><!-- /.section-head -->
                {{--
                <div class="section-actions">
                    <a href="/add-funds/uphold" class="btn btn-primary js-link-internal">@lang('From Uphold Card')</a>

                    <!--<span class="btn btn-primary">@lang('Bank Account Coming Soon!')</span>-->
                </div><!-- /.section-actions -->
                --}}
            </section><!-- /.section-funds -->
        </div><!-- /.container -->
    </main><!-- /.main -->

@endsection