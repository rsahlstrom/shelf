<?php

require('../vendor/autoload.php');

$fetcher = new \Shelf\Fetcher();
$game = $fetcher->getGame(13);

echo $game;
