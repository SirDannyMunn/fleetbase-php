<?php

/**
 * This file is part of the fleetbase/fleetbase-php library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Fleetbase Pte Ltd. <ron@fleetbase.io>
 * @license   http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Fleetbase\Sdk;

/**
 * Fleetbase PHP SDK Array Utility Functions
 */
class Arr
{
    public static function every(array $arr, callable $predicate): bool
    {
        foreach ($arr as $e) {
            if (!call_user_func($predicate, $e)) {
                return false;
            }
        }

        return true;
    }

    public static function any(array $arr, callable $predicate): bool
    {
        return !static::every(
            $arr,
            fn($e): bool => !call_user_func($predicate, $e)
        );
    }

    public static function first(array $arr)
    {
        $arr = array_values($arr);
        return $arr[0] ?? -1;
    }
}
