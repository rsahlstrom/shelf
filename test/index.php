<?php

require('../vendor/autoload.php');

$builder = \Shelf\Builder::factory();
$api2 = $builder->get('v2');
$results = $api2->getBoardgame(
    array(
        'id' => array(34119, 12),
    )
);

foreach ($results->getBoardgames() as $game) {
    echo $game->getBggId() . ': ' . $game->getName() . '<br />';
}
