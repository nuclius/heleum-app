<li>
    <p><b>Move {{ $txn->move_number }}:</b>&nbsp;&nbsp;&nbsp;{{ $txn->origin_amount }} {{ $txn->origin_currency }} @lang('to') {{ $txn->dest_amount }} {{ $txn->dest_currency }} <small>{{ $txn->transaction_timestamp->format('Y-m-d H:i:s') }} UTC</small></p>

    <strong><em class="currency-mark">{{ $txn->getCurrencyMark(Auth::user()->base_currency) }}</em>{{ $txn->latestAmountIn(Auth::user()->base_currency) }}</strong>
</li>
