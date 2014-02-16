<?php

namespace Shelf\Factory;

use Shelf\Entity\Collection;

/**
 * Factory to convert raw data into a Collection Entity
 */
class CollectionFactory extends AbstractFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public static function fromBggXml(\SimpleXMLElement $rawItem)
    {
        return static::fromArray(static::convertXmlItem($rawItem));
    }

    /**
     * {@inheritDoc}
     */
    public static function fromArray(array $itemRow)
    {
        return new Collection($itemRow);
    }

    /**
     * Converts an item from the XML API into an array
     *
     * @param SimpleXMLElement $xmlItem
     *
     * @return array
     */
    public static function convertXmlItem(\SimpleXMLElement $xmlItem)
    {
        $arrayItem = array(
            'bgg_id' => (int) $xmlItem['objectid'],
            'type' => (string) $xmlItem['objecttype'],
            'subtype' => (string) $xmlItem['subtype'],
            'coll_id' => (int) $xmlItem['collid'],
            'name' => array(
                'value' => (string) $xmlItem->name,
                'type' => 'primary',
                'sort_index' => (int) $xmlItem->name['sortindex'],
            ),
            'year_published' => null,
            'bgg_image_url' => null,
            'bgg_thumbnail_url' => null,
            'own' => (int) $xmlItem->status['own'] == 1,
            'previously_owned' => (int) $xmlItem->status['prevowned'] == 1,
            'for_trade' => (int) $xmlItem->status['fortrade'] == 1,
            'want' => (int) $xmlItem->status['want'] == 1,
            'want_to_play' => (int) $xmlItem->status['wanttoplay'] == 1,
            'want_to_buy' => (int) $xmlItem->status['wanttobuy'] == 1,
            'wishlist' => (int) $xmlItem->status['wishlist'] == 1,
            'wishlist_priority' => null,
            'preordered' => (int) $xmlItem->status['preordered'] == 1,
            'last_modified' => new \DateTime((string) $xmlItem->status['lastmodified']),
            'num_plays' => null,
            'comment' => null,
            'stats' => null,
        );

        if ($xmlItem->image) {
            $arrayItem['year_published'] = (int) $xmlItem->yearpublished;
            $arrayItem['bgg_image_url'] = (string) $xmlItem->image;
            $arrayItem['bgg_thumbnail_url'] = (string) $xmlItem->thumbnail;
            $arrayItem['num_plays'] = (int) $xmlItem->numplays;
        }

        if ($xmlItem->status['wishlistpriority']) {
            $arrayItem['wishlist_priority'] = (int) $xmlItem->status['wishlistpriority'];
        }

        if ($xmlItem->comment) {
            $arrayItem['comment'] = (string) $xmlItem->comment;
        }

        if ($xmlItem->stats) {
            $stats = $xmlItem->stats;

            $arrayItem['stats'] = array(
                'min_players' => (int) $stats['minplayers'],
                'max_players' => (int) $stats['maxplayers'],
                'playing_time' => (int) $stats['playingtime'],
                'num_owned' => (int) $stats['numowned'],
                'rating' => null,
                'ranks' => null,
            );

            $rating = $stats->rating;
            $personalRating = (float) $rating['value'];
            if ($personalRating == 0) {
                $personalRating = null;
            }

            $arrayItem['stats']['rating'] = array(
                'personal' => $personalRating,
                'users_rated' => (int) $rating->usersrated['value'],
                'average' => (float) $rating->average['value'],
                'bayes_average' => (float) $rating->bayesaverage['value'],
                'std_dev' => (float) $rating->stddev['value'],
                'median' => (float) $rating->median['value'],
            );

            $ranks = array();
            foreach ($rating->ranks->rank as $rank) {
                $value = (int) $rank['value'];
                if ($value === 0) {
                    $value = null;
                }

                $ranks[] = array(
                    'type' => (string) $rank['type'],
                    'id' => (int) $rank['id'],
                    'name' => (string) $rank['name'],
                    'friendly_name' => (string) $rank['friendlyname'],
                    'value' => $value,
                    'bayes_average' => (float) $rank['bayesaverage'],
                );
            }
            $arrayItem['stats']['ranks'] = $ranks;
        }

        return $arrayItem;
    }
}
