<li>
    {{-- Left Side --}}
    <p>
        @if (trim($referral->referredName()) === '')
            {{ $referral->referred_email }}
        @else
            {{ $referral->referredName() }}
        @endif
    </p>


    {{-- Right Side --}}
    <strong>
        {{ $referral->getTimeTillBoostActivation() }}
    </strong>
</li>
