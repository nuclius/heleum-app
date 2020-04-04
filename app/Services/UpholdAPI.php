<?php

namespace App\Services;

use Auth;
use Cache;
use Log;

use App\Card;
use App\UpholdCard;

class UpholdAPI
{
    const USE_CACHE = false;
    const CACHE_LENGTH = 10; // In Minutes

    public static $domain = null;
    public static $client_id = null;
    public static $client_state = null;
    public static $client_scope = null;
    public static $appCardIds = [];

    public function __construct()
    {
        self::$domain = config('uphold.domain');
        self::$client_id = config('uphold.client_id');
        self::$client_state = config('uphold.client_state');
        self::$client_scope = config('uphold.client_scope');
    }

    public static function getUser($token)
    {
        $api = resolve('Uphold\UpholdClient');
        $upholdUser = $api->getUser($token);
        return $upholdUser;
    }

    public static function getCard($cardId)
    {
        Log::debug(sprintf('Looking for Card ID: %s', $cardId));
        $cards = self::getAllCards();
        $index = $cards->search(function($_card, $key) use ($cardId) {
            Log::debug(sprintf('Card ID: %s', $_card->getId()));
            return ($_card->getId() === $cardId);
        });
        $card = false;
        if ($index !== false) {
            $card = $cards[$index];
        }
        Log::debug('Card Found: ', ['card' => $card]);
        return $card;
    }

    protected static function _getAllCards()
    {
        Log::info('Getting all the user cards.  Possibly from cache.');
        $cacheKey = sprintf('user-%d-cards', Auth::id());
        $cards = (self::USE_CACHE) ? Cache::get($cacheKey, false) : [];
        if (empty($cards) || !self::USE_CACHE) {
            Log::info('No cards, or not using cache - reaching out to API now...');
            $upholdUser = self::getUser(Auth::user()->token);
            $upholdCards = [];
            $_cards = $upholdUser->getCards();
            foreach ($_cards as $card) {
                $cards[] = new UpholdCard($card);
            }
            if (self::USE_CACHE) {
                Log::info('Putting cache now');
                Cache::forget($cacheKey); // clear the stored value first
                Cache::put($cacheKey, $cards, self::CACHE_LENGTH);
            }
        }
        return collect($cards);
    }

    /**
     * Retrieves ALL the logged-in user's heleum cards from the
     * Heleum API.  This will include the <HELEUM APP USE ONLY>
     * cards as well.
     *
     * @return Collection Collection of UpholdCard objects
     */
    public static function getAllCards()
    {
        $cards = self::_getAllCards();
        return $cards;
    }

    /**
     * Retrieves the logged-in user's heleum cards from the
     * Heleum API.
     *
     * NOTE: This will NOT return any <HELEUM APP USE> cards.
     *
     * @return Collection Collection of UpholdCard objects
     */
    public static function getUserCards()
    {
        $upholdCards = self::getAllCards();
        $upholdCards = collect($upholdCards)->reject(function($card, $key){
            return $card->isHeleumCard();
        });
        return $upholdCards;
    }

    /**
     * Retrieves the logged-in user's Heleum App cards
     *
     * @return Collection Collection of UpholdCard objects
     */
    public static function getAppCards()
    {
        $upholdCards = self::getAllCards();
        $upholdCards = collect($upholdCards)->filter(function($card, $key){
            return $card->isHeleumCard();
        });
        return $upholdCards;
    }

    /**
     * Retrieves the logged-in user's heleum cards from the
     * Heleum API.  Only cards with a Balance are returned.
     *
     * @return Collection Collection of UpholdCard objects
     */
    public static function getUserCardsWithBalance()
    {
        $cards = self::getUserCards();
        return $cards->reject(function($card, $key){
            $balance = $card->getBalance();
            return ($balance === '0.00');
        });
    }

}
