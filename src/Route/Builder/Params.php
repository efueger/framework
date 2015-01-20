<?php
/**
 *
 */

namespace Framework\Route\Builder;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
trait Params
{
    /**
     * @param array $tokens
     * @return array
     */
    public static function params(array $tokens)
    {
        $index = 1;
        $map   = [];

        foreach($tokens as $token) {
            'parameter' == $token[Args::TYPE] && $map['param' . $index++] = $token[Args::NAME];
        }

        return $map;
    }
}
