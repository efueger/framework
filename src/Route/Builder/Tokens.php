<?php
/**
 *
 */

namespace Mvc5\Route\Builder;

use RuntimeException;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
trait Tokens
{
    /**
     * @param $subject
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    public static function tokens($subject, $delimiter = '/')
    {
        $currentPos = 0;
        $delimiter  = preg_quote($delimiter);
        $length     = strlen($subject);
        $level      = 0;
        $tokens     = [];

        while($currentPos < $length) {

            preg_match('(\G(?P<literal>[^:{\[\]]*)(?P<token>[:\[\]]|$))', $subject, $matches, 0, $currentPos);

            $currentPos += strlen($matches[0]);

            !empty($matches['literal']) && $tokens[] = ['literal', $matches['literal']];

            if (':' === $matches['token']) {
                $pattern = '(\G(?P<name>[^:' . $delimiter . '{\[\]]+)(?:{(?P<delimiters>[^}]+)})?:?)';
                $result  = preg_match($pattern, $subject, $matches, 0, $currentPos);

                if (!$result) {
                    throw new RuntimeException('Found empty parameter name');
                }

                $tokens[] = [
                    'parameter',
                    $matches['name'],
                    isset($matches['delimiters']) ? $matches['delimiters'] : null
                ];

                $currentPos += strlen($matches[0]);

                continue;
            }

            if ('[' === $matches['token']) {
                $tokens[] = ['optional-start'];
                $level++;
                continue;
            }

            if (']' === $matches['token']) {
                $tokens[] = ['optional-end'];

                $level--;

                if ($level < 0) {
                    throw new RuntimeException('Found closing bracket without matching opening bracket');
                }
                continue;
            }
        }

        if ($level > 0) {
            throw new RuntimeException('Found unbalanced brackets');
        }

        return $tokens;
    }
}
