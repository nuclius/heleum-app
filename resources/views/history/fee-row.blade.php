<tr>
    <td>
        <div>@lang('Fee')</div>
    </td>

    <td>
        <div>
            <span><small class="mobile-only">@lang('To') </small>@lang('Heleum')</span>
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
            <span class="fee">-<em class="currency-mark">{{ $currencyService::convertCurrencyToMark($txn->destination_currency) }}</em>{{ number_format($txn->amount, 2) }}</span>
        </div>
    </td>
</tr>
