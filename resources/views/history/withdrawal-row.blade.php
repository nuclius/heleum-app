<tr>
    <td>
        <div>@lang('Withdrawal')</div>
    </td>

    <td>
        <div>
            <span><small class="mobile-only">@lang('To') </small>{{ $txn->destination_currency }} @lang('Card')</span>
        </div>
    </td>

    <td>
        <div>
            <span>{{ $txn->timestamp->format('d M Y') }}</span>
        </div>
    </td>

    <td>
        <div>
            @inject('currencyService', 'App\Services\CurrencyService')
            <span class="withdraw">-<em class="currency-mark">{{ $currencyService::convertCurrencyToMark($txn->destination_currency) }}</em>{{ number_format($txn->amount, 2) }}</span>
        </div>
    </td>
</tr>
