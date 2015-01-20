<?php
/**
 *
 */

namespace Framework\Route\Builder;

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
