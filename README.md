# Example

```php
<?php

include 'vendor/autoload.php';

$client = Shelf\Client::factory();
$response = $client->getBoardgame(
    array('id' => 13)
);
$game = $response->getBoardgame();

echo $game->getPrimaryName()->getValue();
```
