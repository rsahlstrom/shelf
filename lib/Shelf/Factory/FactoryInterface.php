<?php

namespace Shelf\Factory;

interface FactoryInterface
{
    public static function createGame($data);
    public static function createGames($data);
}
