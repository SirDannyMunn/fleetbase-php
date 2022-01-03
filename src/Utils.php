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

use Doctrine\Inflector\InflectorFactory;
use Closure;

/**
 * Fleetbase PHP SDK Utility Functions
 */
class Utils
{
    public static function pluralize(string $string)
    {
        $inflector = InflectorFactory::create()->build();
        return $inflector->pluralize($string);
    }

    public static function classify(string $string)
    {
        $inflector = InflectorFactory::create()->build();
        return $inflector->classify($string);
    }

    public static function get($target, $key, $default = null)
    {
        if (is_null($key) || trim($key) === '') {
            return $target;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($target) && !isset($target[$segment])) {
                return static::value($default);
            }

            if (is_object($target) && !isset($target->{$segment})) {
                return static::value($default);
            }

            if (is_array($target) && isset($target[$segment])) {
                $target = $target[$segment];
            }

            if (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            }
        }

        return $target;
    }

    public static function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

    public static function dd()
    {
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());

        die(1);
    }
}
