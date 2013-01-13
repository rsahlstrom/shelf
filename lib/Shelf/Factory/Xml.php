<?php

namespace Shelf\Factory;

class Xml implements FactoryInterface
{
    public static function createGame($data)
    {
        return 'test1';
    }

    public static function createGames($data)
    {
        return self::createGame($data);
    }
}
