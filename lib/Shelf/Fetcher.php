<?php

namespace Shelf;

use Shelf\Factory\Xml as Factory;
use Shelf\Exception\UnexpectedValueException;

use Buzz\Browser;

class Fetcher
{
    protected $browser;

    public function __construct(Browser $browser = null)
    {
        if ($browser == null) {
            $browser = new Browser();
        }
        $this->browser = $browser;
    }

    public function getGame($id)
    {
        $games = $this->getGames(array($id));
        return $games;
    }

    public function getGames(array $ids)
    {
        $params = array(
            'id' => implode(',', $ids),
            'thing' => 'boardgame,boardgameexpansion',
        );
        $queryString = http_build_query($params);

        $response = $this->browser->get($this->getUrl() . 'thing?' . $queryString);
        if (!$response->isSuccessful()) {
            throw new UnexpectedValueException($response->getReasonPhrase(), $response->getStatusCode());
        }

        return Factory::createGames($response->getContent());
    }

    protected function getUrl()
    {
        return 'http://boardgamegeek.com/xmlapi2/';
    }
}
