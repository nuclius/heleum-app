<li @if ($card->isFavorite()) class="list-item-favorite" @endif>
    <a href="#"
        class="js-select-card"
        data-target="#selected-card"
        data-cardid="{{ $card->getId() }}"
        data-currency="{{ $card->getCurrency() }}"
        data-currencymark="{{ $card->getCurrencyMark() }}"
        >
        <span>
            <small class="currency">{{ $card->getCurrency() }}</small>
        </span>

        <strong>{{ $card->getTitle() }}</strong>

        <small><em class="currency-mark">{{ $card->getCurrencyMark() }}</em>{{ $card->getAvailable() }} <em class="currency">{{ $card->getCurrency() }}</em></small>

        <i class="ico-star"></i>
    </a>
</li>
