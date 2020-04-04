<header class="header">
    <div class="container">
        <button type="button" class="btn btn-clear hidden" id="nav-open">
            <i class="ico-burger"></i>

            <small class="desktop-only">@lang('Menu')</small>
        </button>

        <a href="#" class="btn btn-clear hidden" id="btn-back" role="button">
            <i class="ico-back"></i>

            <small class="desktop-only"></small>
        </a>

        <span class="logo">
            <a href="/account" class="js-link-internal">
                <img src="/css/images/logo@2x.png" alt="Heleum Brand Image" >
            </a>
        </span>

        @if (Auth::user()->isVerified())
        <span class="btn-clear hidden" id="btn-balance">
            <a href="/history" class="js-link-internal">
                <em class="currency-mark">{{ Auth::user()->getBaseCurrencySymbol() }}</em>{{ number_format(Auth::user()->getBalance(), 2) }}
            </a>
            {{--
            <a href="/add-funds" class="js-link-internal">
                <i class="ico-add"></i>
            </a>
            --}}
        </span>
        @endif

    </div><!-- /.container -->
</header><!-- /.header -->
