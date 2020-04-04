<?php

namespace App;

use Auth;
use App\Services\CurrencyService;

class UpholdCard
{
    /**
     * Takes in an Uphold\Model\Card and assigns all its properties to itself
     */
    public function __construct(\Uphold\Model\Card $upholdCard)
    {
        $this->id = $upholdCard->getId();
        $this->address = $upholdCard->getAddress();
        $this->available = $upholdCard->getAvailable();
        $this->balance = $upholdCard->getBalance();
        $this->currency = $upholdCard->getCurrency();
        $this->id = $upholdCard->getId();
        $this->label = $upholdCard->getLabel();
        $this->lastTransactionAt = $upholdCard->getLastTransactionAt();
        $this->settings = $upholdCard->getSettings();
        // Presently we are not utilizing the "addresses" available in the card
        // This makes extra API calls for each card, which is slow and increases
        // our API calls.  Commenting this out for now.
        // try {
        //     $this->addresses = $upholdCard->getAddresses();
        // } catch (\Exception $e) {
        //     $this->addresses = [];
        // }
    }

    /**
     * Determines if this is a Heleum-App Card based on the presence of the
     * card's ID being in the list of heleum cards in the database.
     *
     * @return boolean
     */
    public function isHeleumCard()
    {
        if (!isset($this->isHeleumCard)) {
            static $appCardIds = null;
            if (is_null($appCardIds)) {
                $appCardIds = Card::where('heleum_user', Auth::id())
                                     ->pluck('uphold_card_id');
            }
            $this->isHeleumCard = $appCardIds->contains($this->getId());
        }
        return $this->isHeleumCard;
    }

    public function isFavorite()
    {
        return (bool) $this->settings['starred'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCurrencyMark()
    {
        return CurrencyService::convertCurrencyToMark($this->getCurrency());
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function getTitle()
    {
        return $this->label;
    }
}
