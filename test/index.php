<?php

require('../vendor/autoload.php');

$builder = \Shelf\Builder::factory();
$api2 = $builder->get('v2');
$results = $api2->getBoardgame(
    array(
        'id' => array(13),
    )
);

foreach ($results->getBoardgames() as $game) {
    echo $game->getBggId() . ': ' . $game->getName() . '<br />';
    echo nl2br($game->getDescription());
    echo '<pre>';
    print_r($game->getPublishers());

    foreach ($game->getExpansions() as $expansion) {
        echo $expansion->getBggId() . ': ' . $expansion->getName() . '<br />';
    }
}
