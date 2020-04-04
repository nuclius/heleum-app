@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">


        @include('partials/error-alert')


        <section class="section-primary">
            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">Yearly Transaction Download</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <form action="/account/csv" method="post">
                        <div class="row">
                            <div class="three columns">&nbsp;</div>
                            <div class="six columns">
                                    {{ csrf_field() }}
                                    <select name="year">
                                        @foreach ($availableYears as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="three columns">&nbsp;</div>
                            <div class="six columns">
                                <div style="text-align: center;"><button class="button-primary" type="submit">Download CSV</button></div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.container -->
            </div><!-- /.section-body -->

        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->

@endsection