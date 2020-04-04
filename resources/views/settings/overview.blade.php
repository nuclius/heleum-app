@extends('layouts.main')

@section('content')

    <main class="main main-primary" data-show-nav-button="true" data-show-balance-button="false" data-show-back-button="false" data-back-url="/account" data-back-text="Heleum Overview" id="cnt">


        @include('partials/error-alert')


        <section class="section-primary">
            <header class="section-subhead">
                <div class="container">
                    <h2 class="section-title">Settings</h2><!-- /.section-title -->
                </div><!-- /.container -->
            </header><!-- /.section-subhead -->

            <div class="section-body">
                <div class="container">
                    <form action="/settings" method="post">
                        {{ csrf_field() }}


                    <ul class="list-referrals">
                        <li>
                            <a href="#" class="{{ (!$user->hasValidBaseCurrency()) ? 'js-edit-currency' : '' }}">
                                <p>
                                    <strong>Base Currency</strong>
                                    <br><br>
                                    @if (!$user->hasValidBaseCurrency())
                                        To use Heleum, you must use one of the Base Currencies listed below.<br>
                                        Please click the "Base Currency" row above to choose a valid base currency to use with Heleum.<br>
                                        Valid Currencies: {{ implode(', ', $currencies->transform(function($item, $key){ return strtoupper($item); })->toArray()) }}
                                    @else
                                        @if (session()->has('updatedCurrency'))
                                        Your Heleum base currency, {{ session()->get('updatedCurrency') }}, has been saved.&nbsp;<br>
                                        @endif
                                        Presently you cannot change your Base Currency in Heleum once it's set to a valid currency.<br>
                                        Please Contact Support if you have further questions.
                                    @endif
                                </p>
                                <span>{{ $user->base_currency }}</span>
                            </a>
                        </li>
                        <li>
                            <strong>Hide my name from my referrer and my referral link</strong>

                            <span>
                                <input type="checkbox" name="hide_name" value="1"
                                @if ($user->hide_name)
                                    checked="checked"
                                @endif
                                >
                            </span>
                        </li>
                    </ul><!-- /.list-referrals -->
                    <div style="text-align: center;"><button class="btn btn-secondary" type="submit">Save Settings</button></div>
                    </form>
                </div><!-- /.container -->

                <div class="modal" id="currency-modal">
                    <div class="modal-inner">
                        <form action="/settings/save-currency" method="post">
                            {{ csrf_field() }}
                            <div class="modal-head">
                                <h2>Select Currency</h2>

                                <button type="button" class="btn btn-clear modal-close">
                                    <i class="ico-add"></i>
                                </button>
                            </div><!-- /.modal-head -->

                            <div class="modal-body">
                                @foreach ($currencies->chunk(3) as $items)
                                <ul class="list-radios">
                                    @foreach ($items as $currency)
                                        <li>
                                            <div class="radio">
                                                <input
                                                    type="radio"
                                                    name="currency"
                                                    id="currency-{{ $currency }}"
                                                    value="{{ $currency }}"
                                                    class="js-radio"
                                                    @if (strtolower($user->base_currency) === strtolower($currency))
                                                        checked="checked"
                                                    @endif
                                                    >

                                                <label for="currency-{{ $currency }}">{{ $currency }}</label>
                                            </div><!-- /.radio -->
                                        </li>
                                    @endforeach
                                </ul>
                                @endforeach
                            </div><!-- /.modal-body -->
                            <div class="modal-footer" style="text-align: center;">
                                <button type="submit" class="btn-primary">Save</button>
                            </div><!-- /.modal-footer -->
                        </form>
                    </div><!-- /.modal-inner -->
                </div><!-- /#bank-modal.modal -->
            </div><!-- /.section-body -->
        </section><!-- /.section-primary -->
    </main><!-- /.main main-primary -->

@endsection