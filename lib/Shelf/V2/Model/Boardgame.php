<?php

namespace Shelf\V2\Model;

use Shelf\Exception\UnexpectedValueException;

class Boardgame extends DataAbstract
{
    public function getBggId()
    {
        return $this->get('bgg_id');
    }

    public function getName()
    {
        $names = $this->get('names', array());

        foreach ($names as $name) {
            if ($name->isPrimary()) {
                return $name->getName();
            }
        }

        if (count($names) > 0) {
            $name = reset($names);
            return $name->getName();
        }

        throw new UnexpectedValueException('No names can be found for this game!');
    }
}
