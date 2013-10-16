# Shelf

A PHP Library to work with the Board Game Geek XML API2 through Guzzle and Entities

## Example

```php
<?php

include 'vendor/autoload.php';

$client = Shelf\Client::factory();

// Getting a single game
$response = $client->getBoardgame(
    array('id' => 13)
);
$game = $response->getBoardgame();

echo '<p>' . $game->getPrimaryName()->getValue() . '</p>';


// Getting a collection of games
$response = $client->getBoardgames(
    array('id' => array(12, 13, 34119))
);
$games = $response->getBoardgames();
foreach ($games as $game) {
    echo '<p>' . $game->getPrimaryName()->getValue() . '</p>';
}
```
