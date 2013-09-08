<?php

/**
 * Inflector
 *
 * Provides a number of methods to inflect words either by doing camelcase, underscore,
 * humanize, or ordinal
 */

namespace Shelf\Common\Utility;

class Inflector
{
    /**
     * Takes a word and turns into camelcase
     *
     * @param string $word
     * @param boolean $headless
     *
     * @return string
     */
    public static function camelcase($word, $headless = true)
    {
        $camelCase = str_replace(
            ' ',
            '',
            ucwords(
                preg_replace(
                    '/[^A-Za-z0-9]+/',
                    ' ',
                    preg_replace(
                        '/(?<=\w)\'(?=\w)/',
                        '',
                        $word
                    )
                )
            )
        );

        if ($headless) {
            $camelCase = lcfirst($camelCase);
        }
        return $camelCase;
    }

    /**
     * Takes a word and changes into an underscored version
     *
     * @param string $word
     *
     * @return string
     */
    public static function underscore($word)
    {
        return strtolower(
            preg_replace(
                '/[^A-z0-9]+/',
                '_',
                preg_replace(
                    '/([a-z])([A-Z0-9])/',
                    '\1_\2',
                    preg_replace(
                        '/([A-Z0-9]+)([A-Z][a-z])/',
                        '\1_\2',
                        preg_replace(
                            '/(?<=\w)\'(?=\w)/',
                            '',
                            $word
                        )
                    )
                )
            )
        );
    }

    /**
     * Takes an underscored or camelcased word and puts back in spaces
     *
     * @param string $word
     * @param boolean $uppercase OPTIONAL
     *
     * @return string
     */
    public static function humanize($word, $uppercase = false)
    {
        $word = self::underscore($word);
        $uppercase = $uppercase ? 'ucwords' : 'strtolower';
        return $uppercase(
            preg_replace(
                '/(\s)+/',
                '$1',
                str_replace(
                    '_',
                    ' ',
                    preg_replace(
                        '/_id$/i',
                        '',
                        $word
                    )
                )
            )
        );
    }
}
