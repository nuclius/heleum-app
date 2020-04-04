<li>
    <a href="/balloon/{{ $balloon->user_balloon_id }}" class="js-link-internal">
        <i class="ico-baloon-1"></i>

        <strong>@lang('Balloon') {{ $balloon->user_balloon_id }}: {{ $balloon->getCurrentCurrency() }}</strong>

        @if ($balloon->isActive())
            <small>@lang('Launched:') {{ $balloon->getStartDate() }}</small>
        @else
            <small>{{ $balloon->getStartDate() }} @lang('to') {{ $balloon->getEndDate() }}</small>
        @endif

        {{-- @TODO inline style needs to be done w/ CSS and be responsive --}}
        @if ($balloon->isPopped())
            <em style="right: 100px">
        @else
            <em>
        @endif
            {{ ($balloon->isUp()) ? '+' : '-' }}{{ abs($balloon->getPercentChange()) }}%
        </em>

        @if ($balloon->isPopped())
            <span>@lang('Popped!')</span>
        @endif
    </a>
</li>
