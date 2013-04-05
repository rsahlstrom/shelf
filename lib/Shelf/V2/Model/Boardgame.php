<?php

namespace Shelf\V2\Model;

use Shelf\V2\Model\Boardgame\Name;

class Boardgame extends DataAbstract
{
    public function getBggId()
    {
        return $this->get('bgg_id');
    }

    public function isExpansion()
    {
        return $this->get('is_expansion');
    }

    public function getDescription()
    {
        return $this->get('description');
    }

    public function getBggImage()
    {
        return $this->get('bgg_image_url');
    }

    public function getBggThumbnail()
    {
        return $this->get('bgg_thumbnail_url');
    }

    public function getMinPlayers()
    {
        return $this->get('min_players');
    }

    public function getMaxPlayers()
    {
        return $this->get('max_players');
    }

    public function getMinAge()
    {
        return $this->get('min_age');
    }

    public function getYearPublished()
    {
        return $this->get('year_published');
    }

    public function getPlayingTime()
    {
        return $this->get('playing_time');
    }

    public function getNames()
    {
        $names = $this->get('names', array());

        $listOfNames = array();
        foreach ($names as $name) {
            $listOfNames[] = $name->getName();
        }

        return $listOfNames;
    }

    public function getSortNames()
    {
        $names = $this->get('names', array());

        $listOfNames = array();
        foreach ($names as $name) {
            $listOfNames[] = $name->getSortName();
        }

        return $listOfNames;
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

        return null;
    }

    public function getCategories()
    {
        return $this->get('category', array());
    }

    public function getMechanics()
    {
        return $this->get('mechanics', array());
    }

    public function getFamilies()
    {
        return $this->get('family', array());
    }

    public function getDesigners()
    {
        return $this->get('designer', array());
    }

    public function getArtists()
    {
        return $this->get('artist', array());
    }

    public function getPublishers()
    {
        return $this->get('publisher', array());
    }

    public function getExpansions()
    {
        if (!$this->get('expansions_processed', false)) {
            $this->processExpansions();
        }

        return $this->get('expansion', array());
    }

    protected function processExpansions()
    {
        if ($this->get('expansions_processed', false)) {
            return;
        }

        $expansions = $this->get('expansion', array());
        $models = array();
        foreach ($expansions as $id => $name) {
            $models[] = $this->processExpansion($id, $name);
        }

        $this->set('expansion', $models);
    }

    protected function processExpansion($id, $name)
    {
        $data = array();
        $data['bgg_id'] = $id;
        $data['is_expansion'] = true;
        $data['names'] = array(
            new Name($name, true),
        );

        return new static($data);
    }
}
