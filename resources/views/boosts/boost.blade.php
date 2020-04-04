<li>
    @if ($boost->type === 'beta')
        <p>@lang('Private Beta Boost')</p>
    @elseif ($boost->type === 'employee')
        <p>@lang('Employee Discount')</p>
    @elseif ($boost->type === 'referral')
        <p>@lang('Referred') {{ $boost->referredWho() }}</p>
    @elseif ($boost->type === 'recovery')
        <p>@lang('Recovery Boost')</p>
    @elseif ($boost->type === 'special')
        <p>@lang('Special Fee Agreement')</p>
    @elseif ($boost->type === 'balance')
        <p>
            @if ($boost->percentage() === 0)
                @lang('Account Boost - Upgrade at $1k')
            @elseif ($boost->percentage() === 5.0)
                 @lang('$1,000 Invested! - Upgrade at $10k')
            @elseif ($boost->percentage() === 10.0)
                 @lang('$10,000 Invested! - Upgrade at $100k')
            @elseif ($boost->percentage() === 15.0)
                 @lang('$100,000 Invested! - Upgrade at $1M')
            @elseif ($boost->percentage() === 20.0)
                 @lang('$1,000,000 Invested!')
            @endif
        </p>
    @endif

    <strong>+ {{ $boost->percentage() }}%</strong>

    {{-- NOT ACTIVATING BOOSTS AT THIS MOMENT
        <a href="#" class="btn btn-secondary btn-secondary-active">Activate</a>
    --}}
</li>
